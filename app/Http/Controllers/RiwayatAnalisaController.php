<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Analisa;
use App\Models\GameplayType;
use App\Models\RiwayatAnalisa;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RiwayatAnalisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $riwayat = Analisa::where('id_users', Auth::id())->where('status', '1')->with('gameplay')->get();

        if ($request->ajax()) {
            $rowData = [];
            foreach ($riwayat as $row) {
                $gameplay = $row->gameplay;

                $rowData[] = [
                    'DT_RowIndex' => $row->id_analisa,
                    'id_analisa' => $row->id_analisa,
                    'gameplay' => $row->gameplay->nama
                ];
            }
            return DataTables::of($rowData)->toJson();
        }

        return view('pages.riwayat.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $analisa = Analisa::where('id_analisa', $id)->first();

        if (!$analisa) {
            return back()->withErrors(['error' => 'Riwayat Hasil analisa tidak ditemukan.']);
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

        return view('pages.riwayat.show', ['gameplay' => $gameplay]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function export()
    {
        $data = Analisa::where('id_users', Auth::id())->where('status', '0')->with('riwayat_analisa.alternatif')->first();

        if (!$data) {
            return back()->withErrors(['error' => 'Data analisa tidak ditemukan. Silahkan coba kembali.']);
        }

        $gameplay = GameplayType::where('id_gameplay', $data->id_gameplay)->first();
        $cekAlternatifGoldLane = Alternatif::where('id_users', Auth::id())->where('laning', 'Gold Lane')->get();
        $cekAlternatifMidLane = Alternatif::where('id_users', Auth::id())->where('laning', 'Mid Lane')->get();
        $cekAlternatifEXPLane = Alternatif::where('id_users', Auth::id())->where('laning', 'EXP Lane')->get();
        $cekAlternatifRoam = Alternatif::where('id_users', Auth::id())->where('laning', 'Roam')->get();
        $cekAlternatifJungle = Alternatif::where('id_users', Auth::id())->where('laning', 'Jungle')->get();
        $riwayat = RiwayatAnalisa::with(['alternatif', 'analisa'])
            ->where('id_analisa', $data->id_analisa)
            ->get();

        $rowDataGoldLane = [];
        foreach ($riwayat as $row) {
            $alternatif = $cekAlternatifGoldLane->where('id_alternatif', $row->id_alternatif)->first();
            if ($alternatif) {
                $rowDataGoldLane[] = [
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
        $rowDataMidLane = [];
        foreach ($riwayat as $row) {
            $alternatif = $cekAlternatifMidLane->where('id_alternatif', $row->id_alternatif)->first();
            if ($alternatif) {
                $rowDataMidLane[] = [
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
        $rowDataEXPLane = [];
        foreach ($riwayat as $row) {
            $alternatif = $cekAlternatifEXPLane->where('id_alternatif', $row->id_alternatif)->first();
            if ($alternatif) {
                $rowDataEXPLane[] = [
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
        $rowDataRoam = [];
        foreach ($riwayat as $row) {
            $alternatif = $cekAlternatifRoam->where('id_alternatif', $row->id_alternatif)->first();
            if ($alternatif) {
                $rowDataRoam[] = [
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
        $rowDataJungle = [];
        foreach ($riwayat as $row) {
            $alternatif = $cekAlternatifJungle->where('id_alternatif', $row->id_alternatif)->first();
            if ($alternatif) {
                $rowDataJungle[] = [
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

        $data->status = '1';

        if ($data->save()) {
            $html = view('pages.export.hasil', ['rowDataGoldLane' => $rowDataGoldLane, 'rowDataMidLane' => $rowDataMidLane, 'rowDataEXPLane' => $rowDataEXPLane, 'rowDataRoam' => $rowDataRoam, 'rowDataJungle' => $rowDataJungle, 'gameplay' => $gameplay])->render();

            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

            $dompdf->stream('Hasil_Analisa_Metode_Electre_Strategi_' . $gameplay->nama . '.pdf');
        } else {
            return back()->withErrors(['error' => 'Gagal memperbarui status analisa.']);
        }
    }
}
