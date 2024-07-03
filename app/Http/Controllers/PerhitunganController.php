<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Analisa;
use App\Models\BobotKriteria;
use App\Models\GameplayType;
use App\Models\Hero;
use App\Models\Kriteria;
use App\Models\RiwayatAnalisa;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PerhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriteria = Kriteria::all();
        $subkriteria = Subkriteria::all();
        $gameplay = GameplayType::all();

        $cekAlternatif = Alternatif::where('id_users', Auth::id())->get();

        $goldLane = $cekAlternatif->filter(function ($item) {
            return $item->laning == 'Gold Lane';
        })->count();

        $roam = $cekAlternatif->filter(function ($item) {
            return $item->laning == 'Roam';
        })->count();

        $jungler = $cekAlternatif->filter(function ($item) {
            return $item->laning == 'Jungle';
        })->count();

        $midLane = $cekAlternatif->filter(function ($item) {
            return $item->laning == 'Mid Lane';
        })->count();

        $expLane = $cekAlternatif->filter(function ($item) {
            return $item->laning == 'EXP Lane';
        })->count();

        if ($goldLane < 5 || $roam < 5 || $jungler < 5 || $midLane < 5 || $expLane < 5) {
            if (Auth::user()->id_role == 1) {
                return redirect()->route('admin.alternatif')->withErrors(['Lengkapi Data Alternatif dahulu. Setiap laning minimal 5 Hero.']);
            } else {
                return redirect()->route('alternatif')->withErrors(['Lengkapi Data Alternatif dahulu. Setiap laning minimal 5 Hero.']);
            }
        }

        $analisa = Analisa::where('id_users', Auth::id())->where('status', '0')->first();
        if (!$analisa) {
            if (Auth::user()->id_role == 1) {
                return redirect()->route('admin.alternatif')->withErrors(['Anda belum memulai analisa']);
            } else {
                return redirect()->route('alternatif')->withErrors(['Anda belum memulai analisa']);
            }
        }

        $laning = $request->get('laning');
        $alternatif = Alternatif::with('detail_alternatif')
            ->where('laning', $laning)
            ->where('id_users', Auth::id())
            ->get();

        if ($request->ajax()) {
            $rowData = [];

            foreach ($alternatif as $row) {
                $detailAlternatif = $row->detail_alternatif;
                $subkriteriaData = [];

                foreach ($detailAlternatif as $detail) {
                    $kriteria = Kriteria::find($detail->id_kriteria);
                    $subkriteria = Subkriteria::find($detail->id_subkriteria);

                    if ($kriteria && $subkriteria) {
                        $subkriteriaData[$kriteria->nama] = $subkriteria->nilai;
                    }
                }

                $rowData[] = [
                    'DT_RowIndex' => $row->id_alternatif,
                    'id_alternatif' => $row->id_alternatif,
                    'foto' => $row->foto,
                    'nama' => $row->nama,
                    'role' => $row->role,
                    'laning' => $row->laning,
                    'subkriteria' => $subkriteriaData,
                ];
            }

            return DataTables::of($rowData)->toJson();
        }

        return view('pages.perhitungan.index', ['kriteria' => $kriteria, 'detailKriteria' => $subkriteria, 'gameplay' => $gameplay]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gameplay' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $bobot = BobotKriteria::count();

            if (!$bobot) {
                throw new \Exception('Bobot kriteria masih kosong. Silahkan isi terlebih dahulu.');
            }

            DB::beginTransaction();

            $analisa = Analisa::where('id_users', Auth::id())->where('status', '0')->first();
            if ($analisa) {
                if ($analisa->delete()) {
                    $analisa = new Analisa();
                    $analisa->id_users = Auth::id();
                    $analisa->id_gameplay = $request->gameplay;
                    $analisa->save();
                } else {
                    throw new \Exception('Analisa ganti strategi tidak berhasil. Silahkan Coba lagi');
                }
            } else {
                $analisa = new Analisa();
                $analisa->id_users = Auth::id();
                $analisa->id_gameplay = $request->gameplay;
                $analisa->save();
            }

            $alternatif = Alternatif::where('id_users', Auth::id())->get();

            $goldLane = $alternatif->filter(function ($item) {
                return $item->laning == 'Gold Lane';
            })->count();

            $roam = $alternatif->filter(function ($item) {
                return $item->laning == 'Roam';
            })->count();

            $jungler = $alternatif->filter(function ($item) {
                return $item->laning == 'Jungle';
            })->count();

            $midLane = $alternatif->filter(function ($item) {
                return $item->laning == 'Mid Lane';
            })->count();

            $expLane = $alternatif->filter(function ($item) {
                return $item->laning == 'EXP Lane';
            })->count();

            if ($goldLane < 5 || $roam < 5 || $jungler < 5 || $midLane < 5 || $expLane < 5) {
                throw new \Exception('Setiap laning minimal 5 Data Alternatif.');
            }

            DB::commit();

            if (Auth::user()->id_role == 1) {
                return redirect()->route('admin.perhitungan')->with('success', 'Data Hasil Perhitungan berhasil.');
            } else {
                return redirect()->route('perhitungan')->with('success', 'Data Hasil Perhitungan berhasil.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function getAlternatif($laning)
    {
        return Alternatif::with('detail_alternatif')
            ->where('laning', $laning)
            ->where('id_users', Auth::id())
            ->get();
    }

    private function getAnalisa()
    {
        return Analisa::where('id_users', Auth::id())->where('status', '0')->first();
    }

    private function getWeights($gameplay)
    {
        return BobotKriteria::where('id_gameplay', $gameplay)->pluck('bobot')->toArray();
    }

    private function buildMatrix($alternatif, $kriteria)
    {
        $matrix = [];
        foreach ($alternatif as $alt) {
            $row = [];
            foreach ($kriteria as $krit) {
                $detailAlternatif = $alt->detail_alternatif()->where('id_kriteria', $krit->id_kriteria)->first();
                $subkriteria = Subkriteria::where('id_subkriteria', $detailAlternatif->id_subkriteria)->first();
                $row[] = $subkriteria ? $subkriteria->nilai : 0;
            }
            $matrix[] = $row;
        }
        return $matrix;
    }

    private function prepareRowData($alternatif, $kriteria, $matrix)
    {
        $rowData = [];
        foreach ($alternatif as $index => $hero) {
            $subkriteriaData = [];
            foreach ($kriteria as $kIndex => $krit) {
                $subkriteriaData[$krit->nama] = $matrix[$index][$kIndex];
            }
            $rowData[] = [
                'DT_RowIndex' => $index + 1,
                'id_hero' => $hero->id_hero,
                'foto' => $hero->foto,
                'nama' => $hero->nama,
                'role' => $hero->role,
                'laning' => $hero->laning,
                'subkriteria' => $subkriteriaData,
            ];
        }
        return $rowData;
    }

    private function preparePairwiseRowData($pairwiseMatrix, $alternatif, $kriteria)
    {
        $rowData = [];
        foreach ($pairwiseMatrix as $pair => $concordance) {
            list($alt1, $alt2) = explode('-', $pair);
            $trueKriteria = [];

            foreach ($concordance as $kriteriaIndex => $isTrue) {
                if ($isTrue) {
                    $trueKriteria[] = $kriteria[$kriteriaIndex]->nama;
                }
            }

            $rowData[] = [
                'DT_RowIndex' => $pair,
                'alternatif_1' => $alternatif[$alt1]->nama,
                'alternatif_2' => $alternatif[$alt2]->nama,
                'true_kriteria' => implode(', ', $trueKriteria),
            ];
        }
        return $rowData;
    }

    private function prepareMatrixRowData($matrix, $alternatif, $kriteria)
    {
        $rowData = [];
        foreach ($matrix as $pair => $value) {
            list($alt1, $alt2) = explode('-', $pair);

            $rowData[] = [
                'DT_RowIndex' => $pair,
                'alternatif_1' => $alternatif[$alt1]->nama,
                'alternatif_2' => $alternatif[$alt2]->nama,
                'value' => $value
            ];
        }

        return $rowData;
    }


    public function normalisasi(Request $request)
    {
        $analisa = $this->getAnalisa();

        if (!$analisa) {
            return redirect()->route('admin.alternatif')->withErrors(['error' => 'Analisa tidak ditemukan.']);
        }

        $laning = $request->get('laning');
        $alternatif = $this->getAlternatif($laning);
        $kriteria = Kriteria::all();

        $matrix = $this->buildMatrix($alternatif, $kriteria);
        $normalisasiMatrix = $this->normalisasiMatrix($matrix);

        $rowData = $this->prepareRowData($alternatif, $kriteria, $normalisasiMatrix);

        return DataTables::of($rowData)->toJson();
    }


    public function pembobotan(Request $request)
    {
        $laning = $request->get('laning');
        $alternatif = $this->getAlternatif($laning);
        $analisa = $this->getAnalisa();

        if (!$analisa) {
            return redirect()->route('admin.alternatif')->withErrors(['error' => 'Analisa tidak ditemukan.']);
        }

        $kriteria = Kriteria::all();
        $weights = $this->getWeights($analisa->id_gameplay);

        $matrix = $this->buildMatrix($alternatif, $kriteria);
        $normalisasiMatrix = $this->normalisasiMatrix($matrix);
        $weightedMatrix = $this->pembobotanNormalisasiMatrix($normalisasiMatrix, $weights);

        $rowData = $this->prepareRowData($alternatif, $kriteria, $weightedMatrix);

        return DataTables::of($rowData)->toJson();
    }

    public function concordance(Request $request)
    {
        $laning = $request->get('laning');
        $alternatif = $this->getAlternatif($laning);

        if ($alternatif->isEmpty()) {
            return response()->json([]);
        }

        $analisa = $this->getAnalisa();

        if (!$analisa) {
            return back()->withErrors(['error' => 'Analisa tidak ditemukan.']);
        }

        $kriteria = Kriteria::all();
        $weights = $this->getWeights($analisa->id_gameplay);

        $matrix = $this->buildMatrix($alternatif, $kriteria);
        $normalisasiMatrix = $this->normalisasiMatrix($matrix);
        $weightedMatrix = $this->pembobotanNormalisasiMatrix($normalisasiMatrix, $weights);

        $concordanceMatrix = $this->concordanceIndex($weightedMatrix);
        $rowData = $this->preparePairwiseRowData($concordanceMatrix, $alternatif, $kriteria);

        return DataTables::of($rowData)->toJson();
    }

    public function discordance(Request $request)
    {
        $laning = $request->get('laning');
        $alternatif = $this->getAlternatif($laning);

        if ($alternatif->isEmpty()) {
            return response()->json([]);
        }

        $analisa = $this->getAnalisa();

        if (!$analisa) {
            return back()->withErrors(['error' => 'Analisa tidak ditemukan.']);
        }

        $kriteria = Kriteria::all();
        $weights = $this->getWeights($analisa->id_gameplay);

        $matrix = $this->buildMatrix($alternatif, $kriteria);
        $normalisasiMatrix = $this->normalisasiMatrix($matrix);
        $weightedMatrix = $this->pembobotanNormalisasiMatrix($normalisasiMatrix, $weights);

        $discordanceMatrix = $this->discordanceIndex($weightedMatrix);
        $rowData = $this->preparePairwiseRowData($discordanceMatrix, $alternatif, $kriteria);

        return DataTables::of($rowData)->toJson();
    }

    public function matrixConcordance(Request $request)
    {
        $laning = $request->get('laning');
        $alternatif = $this->getAlternatif($laning);

        if ($alternatif->isEmpty()) {
            return response()->json([]);
        }

        $analisa = $this->getAnalisa();

        if (!$analisa) {
            return back()->withErrors(['error' => 'Analisa tidak ditemukan.']);
        }

        $kriteria = Kriteria::all();
        $weights = $this->getWeights($analisa->id_gameplay);

        $matrix = $this->buildMatrix($alternatif, $kriteria);
        $normalisasiMatrix = $this->normalisasiMatrix($matrix);
        $weightedMatrix = $this->pembobotanNormalisasiMatrix($normalisasiMatrix, $weights);

        $concordanceMatrix = $this->hitungMatrixConcordance($weightedMatrix, $weights);
        $rowData = $this->prepareMatrixRowData($concordanceMatrix, $alternatif, $kriteria);

        return DataTables::of($rowData)->toJson();
    }

    public function matrixDiscordance(Request $request)
    {
        $laning = $request->get('laning');
        $alternatif = $this->getAlternatif($laning);

        if ($alternatif->isEmpty()) {
            return response()->json([]);
        }

        $analisa = $this->getAnalisa();

        if (!$analisa) {
            return back()->withErrors(['error' => 'Analisa tidak ditemukan.']);
        }

        $kriteria = Kriteria::all();
        $weights = $this->getWeights($analisa->id_gameplay);

        $matrix = $this->buildMatrix($alternatif, $kriteria);
        $normalisasiMatrix = $this->normalisasiMatrix($matrix);
        $weightedMatrix = $this->pembobotanNormalisasiMatrix($normalisasiMatrix, $weights);

        $discordanceMatrix = $this->hitungMatrixDiscordance($weightedMatrix);
        $rowData = $this->prepareMatrixRowData($discordanceMatrix, $alternatif, $kriteria);

        return DataTables::of($rowData)->toJson();
    }

    public function matrixDominanceConcordance(Request $request)
    {
        $laning = $request->get('laning');
        $alternatif = $this->getAlternatif($laning);

        if ($alternatif->isEmpty()) {
            return response()->json([]);
        }

        $analisa = $this->getAnalisa();

        if (!$analisa) {
            return back()->withErrors(['error' => 'Analisa tidak ditemukan.']);
        }

        $kriteria = Kriteria::all();
        $weights = $this->getWeights($analisa->id_gameplay);

        $matrix = $this->buildMatrix($alternatif, $kriteria);
        $normalisasiMatrix = $this->normalisasiMatrix($matrix);
        $weightedMatrix = $this->pembobotanNormalisasiMatrix($normalisasiMatrix, $weights);
        $concordanceMatrix = $this->hitungMatrixConcordance($weightedMatrix, $weights);

        $numAlternatives = count($alternatif);
        $concordanceThreshold = $this->hitungThresholdConcordance($concordanceMatrix, $numAlternatives);

        $concordanceDominanceMatrix = $this->hitungMatrixDominanceConcordance($concordanceMatrix, $concordanceThreshold);

        $rowData = $this->prepareMatrixRowData($concordanceDominanceMatrix, $alternatif, $kriteria);

        return DataTables::of($rowData)->toJson();
    }

    public function matrixDominanceDiscordance(Request $request)
    {
        $laning = $request->get('laning');
        $alternatif = $this->getAlternatif($laning);

        if ($alternatif->isEmpty()) {
            return response()->json([]);
        }

        $analisa = $this->getAnalisa();

        if (!$analisa) {
            return back()->withErrors(['error' => 'Analisa tidak ditemukan.']);
        }

        $kriteria = Kriteria::all();
        $weights = $this->getWeights($analisa->id_gameplay);

        $matrix = $this->buildMatrix($alternatif, $kriteria);
        $normalisasiMatrix = $this->normalisasiMatrix($matrix);
        $weightedMatrix = $this->pembobotanNormalisasiMatrix($normalisasiMatrix, $weights);
        $discordanceMatrix = $this->hitungMatrixDiscordance($weightedMatrix);

        $numAlternatives = count($alternatif);
        $discordanceThreshold = $this->hitungThresholdDiscordance($discordanceMatrix, $numAlternatives);

        $discordanceDominanceMatrix = $this->hitungMatrixDominanceDiscordance($discordanceMatrix, $discordanceThreshold);
        // dd($discordanceDominanceMatrix);
        $rowData = $this->prepareMatrixRowData($discordanceDominanceMatrix, $alternatif, $kriteria);

        return DataTables::of($rowData)->toJson();
    }

    public function aggregateMatrixDominance(Request $request)
    {
        $laning = $request->get('laning');
        $alternatif = $this->getAlternatif($laning);

        if ($alternatif->isEmpty()) {
            return response()->json([]);
        }

        $analisa = $this->getAnalisa();

        if (!$analisa) {
            return back()->withErrors(['error' => 'Analisa tidak ditemukan.']);
        }

        $kriteria = Kriteria::all();
        $weights = $this->getWeights($analisa->id_gameplay);

        $matrix = $this->buildMatrix($alternatif, $kriteria);
        $normalisasiMatrix = $this->normalisasiMatrix($matrix);
        $weightedMatrix = $this->pembobotanNormalisasiMatrix($normalisasiMatrix, $weights);

        $concordanceMatrix = $this->hitungMatrixConcordance($weightedMatrix, $weights);
        $discordanceMatrix = $this->hitungMatrixDiscordance($weightedMatrix);

        $numAlternatives = count($alternatif);
        $concordanceThreshold = $this->hitungThresholdConcordance($concordanceMatrix, $numAlternatives);
        $discordanceThreshold = $this->hitungThresholdDiscordance($discordanceMatrix, $numAlternatives);

        $concordanceDominanceMatrix = $this->hitungMatrixDominanceConcordance($concordanceMatrix, $concordanceThreshold);
        $discordanceDominanceMatrix = $this->hitungMatrixDominanceDiscordance($discordanceMatrix, $discordanceThreshold);

        $aggregateDominanceMatrix = $this->hitugnAggregateDominanceMatrix($concordanceDominanceMatrix, $discordanceDominanceMatrix);

        $rankedAlternatives = $this->perankingan($aggregateDominanceMatrix, $alternatif, $analisa);
        // dd($aggregateDominanceMatrix);
        $rowData = $this->prepareMatrixRowData($aggregateDominanceMatrix, $alternatif, $kriteria);

        return DataTables::of($rowData)->toJson();
    }

    public function lessFavorable(Request $request)
    {
        $analisa = $this->getAnalisa();

        if (!$analisa) {
            return back()->withErrors(['error' => 'Hasil analisa tidak ditemukan.']);
        }

        $gameplay = GameplayType::where('id_gameplay', $analisa->id_gameplay)->first();
        $laning = $request->get('laning');
        $cekAlternatif = Alternatif::where('id_users', Auth::id())->where('laning', $laning)->get();

        $riwayat = RiwayatAnalisa::with(['alternatif', 'analisa'])
            ->where('id_analisa', $analisa->id_analisa)
            ->get();

        if ($request->ajax()) {
            $rowData = [];

            foreach ($riwayat as $row) {
                $alternatif = $cekAlternatif->where('id_alternatif', $row->id_alternatif)->first();

                if ($alternatif) {
                    $rowData[] = [
                        'DT_RowIndex' => $row->id_alternatif,
                        'id_alternatif' => $row->id_alternatif,
                        'foto' => $alternatif->foto,
                        'nama' => $alternatif->nama,
                        'role' => $alternatif->role,
                        'laning' => $alternatif->laning,
                        'nilai' => $row->nilai,
                        'rangking' => $row->rangking,
                    ];
                }
            }

            return DataTables::of($rowData)->toJson();
        }

        return view('pages.hasil.index', ['gameplay' => $gameplay]);
    }


    private function normalisasiMatrix($matrix)
    {
        $normalisasiMatrix = [];
        foreach ($matrix[0] as $j => $value) {
            $kuadrat = 0;
            foreach ($matrix as $i => $row) {
                $kuadrat += pow($row[$j], 2);
            }
            foreach ($matrix as $i => $row) {
                $normalisasiMatrix[$i][$j] = $row[$j] / sqrt($kuadrat);
            }
        }
        return $normalisasiMatrix;
    }

    private function pembobotanNormalisasiMatrix($normalizedMatrix, $weights)
    {
        $weightedMatrix = [];
        foreach ($normalizedMatrix as $i => $row) {
            $weightedMatrix[$i] = [];
            foreach ($row as $j => $value) {
                $weightedMatrix[$i][$j] = $value * $weights[$j];
            }
        }
        return $weightedMatrix;
    }

    public function concordanceIndex($weightedMatrix)
    {
        $numAlternatives = count($weightedMatrix);
        $concordanceMatrix = [];

        for ($i = 0; $i < $numAlternatives; $i++) {
            for ($j = 0; $j < $numAlternatives; $j++) {
                if ($i != $j) {
                    $concordanceMatrix["$i-$j"] = $this->hitungConcordance($weightedMatrix[$i], $weightedMatrix[$j]);
                }
            }
        }

        return $concordanceMatrix;
    }

    public function hitungConcordance($alternativeA, $alternativeB)
    {
        $concordanceValue = [];
        foreach ($alternativeA as $index => $value) {
            $concordanceValue[$index] = $value >= $alternativeB[$index];
        }
        return $concordanceValue;
    }

    public function discordanceIndex($weightedMatrix)
    {
        $numAlternatives = count($weightedMatrix);
        $discordanceMatrix = [];

        for ($i = 0; $i < $numAlternatives; $i++) {
            for ($j = 0; $j < $numAlternatives; $j++) {
                if ($i != $j) {
                    $discordanceMatrix["$i-$j"] = $this->hitungDiscordance($weightedMatrix[$i], $weightedMatrix[$j]);
                }
            }
        }

        return $discordanceMatrix;
    }

    public function hitungDiscordance($alternativeA, $alternativeB)
    {
        $discordanceValue = [];
        foreach ($alternativeA as $index => $value) {
            $discordanceValue[$index] = $value < $alternativeB[$index];
        }
        return $discordanceValue;
    }

    private function hitungMatrixConcordance($weightedMatrix, $weights)
    {
        $numAlternatives = count($weightedMatrix);
        $numCriteria = count($weights);
        $concordanceMatrix = [];

        for ($i = 0; $i < $numAlternatives; $i++) {
            for ($j = 0; $j < $numAlternatives; $j++) {
                if ($i != $j) {
                    $concordanceMatrix["$i-$j"] = $this->prosesConcordance($weightedMatrix[$i], $weightedMatrix[$j], $weights, $numCriteria);
                }
            }
        }
        // dd($concordanceMatrix);
        return $concordanceMatrix;
    }

    private function prosesConcordance($alternativeA, $alternativeB, $weights, $numCriteria)
    {
        $concordanceValue = 0;

        for ($k = 0; $k < $numCriteria; $k++) {
            if ($alternativeA[$k] >= $alternativeB[$k]) {
                $concordanceValue += $weights[$k];
            }
        }
        return $concordanceValue;
    }

    private function hitungMatrixDiscordance($weightedMatrix)
    {
        $numAlternatives = count($weightedMatrix);
        $numCriteria = count($weightedMatrix[0]);
        $discordanceMatrix = [];

        for ($i = 0; $i < $numAlternatives; $i++) {
            for ($j = 0; $j < $numAlternatives; $j++) {
                if ($i != $j) {
                    $discordanceMatrix["$i-$j"] = $this->prosesDiscordance($weightedMatrix[$i], $weightedMatrix[$j], $numCriteria);
                }
            }
        }

        return $discordanceMatrix;
    }

    private function prosesDiscordance($alternativeA, $alternativeB, $numCriteria)
    {
        $numerator = 0;
        $denominator = 0;

        for ($k = 0; $k < $numCriteria; $k++) {
            $difference = abs($alternativeA[$k] - $alternativeB[$k]);
            $denominator = max($denominator, $difference);

            if ($alternativeA[$k] < $alternativeB[$k]) {
                $numerator = max($numerator, $difference);
            }
        }

        return $denominator == 0 ? 0 : $numerator / $denominator;
    }

    private function hitungThresholdConcordance($concordanceMatrix, $numAlternatives)
    {
        $sumConcordance = array_sum(array_values($concordanceMatrix));
        $threshold = $sumConcordance / ($numAlternatives * ($numAlternatives - 1));
        return $threshold;
    }

    private function hitungThresholdDiscordance($discordanceMatrix, $numAlternatives)
    {
        $sumConcordance = array_sum(array_values($discordanceMatrix));
        $threshold = $sumConcordance / ($numAlternatives * ($numAlternatives - 1));
        return $threshold;
    }

    private function hitungMatrixDominanceConcordance($concordanceMatrix, $threshold)
    {
        $dominanceMatrix = [];
        foreach ($concordanceMatrix as $pair => $value) {
            $dominanceMatrix[$pair] = ($value >= $threshold) ? 1 : 0;
        }
        return $dominanceMatrix;
    }

    private function hitungMatrixDominanceDiscordance($discordanceMatrix, $threshold)
    {
        $dominanceMatrix = [];
        foreach ($discordanceMatrix as $pair => $value) {
            $dominanceMatrix[$pair] = ($value >= $threshold) ? 1 : 0;
        }
        return $dominanceMatrix;
    }

    private function hitugnAggregateDominanceMatrix($concordanceDominanceMatrix, $discordanceDominanceMatrix)
    {
        $aggregateMatrix = [];

        foreach ($concordanceDominanceMatrix as $pair => $concordanceValue) {
            if (isset($discordanceDominanceMatrix[$pair])) {
                $discordanceValue = $discordanceDominanceMatrix[$pair];
                $aggregateMatrix[$pair] = $concordanceValue * $discordanceValue;
            }
        }

        return $aggregateMatrix;
    }

    private function perankingan($aggregateDominanceMatrix, $alternatif, $analisa)
    {
        $nilai = array_fill(0, count($alternatif), 0);

        foreach ($aggregateDominanceMatrix as $pair => $value) {
            if ($value > 0) {
                list($alt1, $alt2) = explode('-', $pair);
                $nilai[$alt1]++;
            }
        }

        $rankedAlternatives = [];
        foreach ($nilai as $index => $score) {
            $rankedAlternatives[] = [
                'id_alternatif' => $alternatif[$index]->id_alternatif,
                'nilai' => $score,
                'ranking' => 0
            ];
        }

        usort($rankedAlternatives, function ($a, $b) {
            return $b['nilai'] <=> $a['nilai'];
        });

        $ranking = 1;
        foreach ($rankedAlternatives as $index => $alternatif) {
            $existingEntry = RiwayatAnalisa::where('id_analisa', $analisa->id_analisa)
                ->where('id_alternatif', $alternatif['id_alternatif'])
                ->first();

            if ($existingEntry) {
                continue;
            }

            $riwayat_analisa = new RiwayatAnalisa();
            $riwayat_analisa->id_analisa = $analisa->id_analisa;
            $riwayat_analisa->id_alternatif = $alternatif['id_alternatif'];
            $riwayat_analisa->nilai = $alternatif['nilai'];
            $riwayat_analisa->rangking = $ranking;
            $riwayat_analisa->save();
            $ranking++;
        }

        return $rankedAlternatives;
    }
}
