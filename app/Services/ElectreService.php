<?php

namespace App\Services;

use App\Models\Alternatif;
use App\Models\Analisa;
use App\Models\BobotKriteria;
use App\Models\Kriteria;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ElectreService
{
    protected $analisa;
    protected $bobotAnalisa;
    protected $alternatives;
    protected $kriteria;
    protected $bobot;
    protected $normalizedMatrix = [];
    protected $weightedMatrix = [];
    protected $concordanceMatrix = [];
    protected $discordanceMatrix = [];

    public function __construct($laning, $userId)
    {
        $this->analisa = Analisa::where('id_users', $userId)->first();
        $this->kriteria = Kriteria::all();
        if ($this->analisa) {
            $this->bobotAnalisa = BobotKriteria::where('id_gameplay', $this->analisa->id_gameplay)->get();
            $this->bobot = $this->bobotAnalisa->pluck('bobot')->toArray();
            $this->alternatives = $this->loadAlternatives($laning, $userId);
        }
    }

    protected function loadAlternatives($laning, $userId)
    {
        $alternatives = Alternatif::with('detail_alternatif.subkriteria')
            ->where('laning', $laning)
            ->where('id_users', $userId)
            ->get();

        if ($alternatives->isEmpty()) {
            throw new ModelNotFoundException('Alternatif tidak ditemukan.');
        }

        $laningCounts = $alternatives->groupBy('laning')->map->count();
        if ($laningCounts->contains(function ($count) {
            return $count < 5;
        })) {
            throw new \Exception('Lengkapi Data Alternatif dahulu. Setiap laning minimal 5 Hero.');
        }

        return $alternatives;
    }

    public function normalisasi()
    {
        $matrix = [];
        foreach ($this->alternatives as $alt) {
            $row = [];
            foreach ($this->kriteria as $krit) {
                $detailAlternatif = $alt->detail_alternatif()->where('id_kriteria', $krit->id_kriteria)->first();
                $subkriteria = $detailAlternatif->subkriteria;
                $row[] = $subkriteria ? $subkriteria->nilai : 0;
            }
            $matrix[] = $row;
        }

        foreach ($matrix[0] as $j => $value) {
            $kuadrat = 0;
            foreach ($matrix as $i => $row) {
                $kuadrat += pow($row[$j], 2);
            }
            foreach ($matrix as $i => $row) {
                $this->normalizedMatrix[$i][$j] = $row[$j] / sqrt($kuadrat);
            }
        }

        foreach ($this->normalizedMatrix as $i => $row) {
            foreach ($row as $j => $value) {
                DB::table('normalisasi')->insert([
                    'id_alternatif' => $this->alternatives[$i]->id_alternatif,
                    'id_kriteria' => $this->kriteria[$j]->id_kriteria,
                    'value' => $value,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }

    public function pembobotan()
    {
        foreach ($this->normalizedMatrix as $i => $row) {
            foreach ($row as $j => $value) {
                $this->weightedMatrix[$i][$j] = $value * $this->bobot[$j];
            }
        }

        foreach ($this->weightedMatrix as $i => $row) {
            foreach ($row as $j => $value) {
                DB::table('electre_weightings')->insert([
                    'id_alternatif' => $this->alternatives[$i]->id_alternatif,
                    'id_kriteria' => $this->kriteria[$j]->id_kriteria,
                    'value' => $value,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }

    public function himpunanConcordance()
    {
        // Initialize concordance matrix
        $n = count($this->alternatives);
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($i != $j) {
                    $this->concordanceMatrix["$i-$j"] = [];
                    foreach ($this->kriteria as $k => $krit) {
                        $this->concordanceMatrix["$i-$j"][$k] = $this->weightedMatrix[$i][$k] >= $this->weightedMatrix[$j][$k];
                    }
                }
            }
        }

        // Save to DB
        foreach ($this->concordanceMatrix as $pair => $concordances) {
            list($a, $b) = explode('-', $pair);
            foreach ($concordances as $k => $isTrue) {
                DB::table('electre_concordance')->insert([
                    'alternatif_a' => $this->alternatives[$a]->id_alternatif,
                    'alternatif_b' => $this->alternatives[$b]->id_alternatif,
                    'id_kriteria' => $this->kriteria[$k]->id_kriteria,
                    'value' => $isTrue ? 1 : 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }

    public function calculateDiscordanceMatrix()
    {
        // Initialize discordance matrix
        $n = count($this->alternatives);
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($i != $j) {
                    $this->discordanceMatrix["$i-$j"] = [];
                    foreach ($this->kriteria as $k => $krit) {
                        $this->discordanceMatrix["$i-$j"][$k] = abs($this->weightedMatrix[$i][$k] - $this->weightedMatrix[$j][$k]);
                    }
                }
            }
        }

        // Save to DB
        foreach ($this->discordanceMatrix as $pair => $discordances) {
            list($a, $b) = explode('-', $pair);
            foreach ($discordances as $k => $value) {
                DB::table('electre_discordance')->insert([
                    'alternatif_a' => $this->alternatives[$a]->id_alternatif,
                    'alternatif_b' => $this->alternatives[$b]->id_alternatif,
                    'id_kriteria' => $this->kriteria[$k]->id_kriteria,
                    'value' => $value,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }

    public function calculateDominanceMatrix($type = 'concordance', $threshold)
    {
        $matrix = $type === 'concordance' ? $this->concordanceMatrix : $this->discordanceMatrix;
        $dominanceMatrix = [];
        foreach ($matrix as $pair => $values) {
            list($a, $b) = explode('-', $pair);
            $sum = array_sum($values);
            $dominanceMatrix["$a-$b"] = $sum >= $threshold;
        }

        // Save to DB
        $table = $type === 'concordance' ? 'electre_concordance_dominance' : 'electre_discordance_dominance';
        foreach ($dominanceMatrix as $pair => $isTrue) {
            list($a, $b) = explode('-', $pair);
            DB::table($table)->insert([
                'alternatif_a' => $this->alternatives[$a]->id_alternatif,
                'alternatif_b' => $this->alternatives[$b]->id_alternatif,
                'value' => $isTrue,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    public function calculateFinalResults()
    {
        // Combine concordance and discordance dominance matrices
        $n = count($this->alternatives);
        $finalScores = array_fill(0, $n, 0);
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($i != $j) {
                    $concordance = DB::table('electre_concordance_dominance')
                        ->where('alternatif_a', $this->alternatives[$i]->id_alternatif)
                        ->where('alternatif_b', $this->alternatives[$j]->id_alternatif)
                        ->first();

                    $discordance = DB::table('electre_discordance_dominance')
                        ->where('alternatif_a', $this->alternatives[$i]->id_alternatif)
                        ->where('alternatif_b', $this->alternatives[$j]->id_alternatif)
                        ->first();

                    if ($concordance->value && !$discordance->value) {
                        $finalScores[$i]++;
                    }
                }
            }
        }

        // Save final results to DB
        foreach ($finalScores as $i => $score) {
            DB::table('electre_final_results')->insert([
                'id_alternatif' => $this->alternatives[$i]->id_alternatif,
                'nilai_akhir' => $score,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
