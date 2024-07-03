<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SubkriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriteria = Kriteria::all();

        if ($request->ajax()) {
            $subkriteria = Subkriteria::with('data_kriteria')->get();

            $rowData = [];
            foreach ($subkriteria as $row) {
                $kriteria = $row->data_kriteria;

                $rowData[] = [
                    'DT_RowIndex' => $row->id_subkriteria,
                    'id_subkriteria' => $row->id_subkriteria,
                    'subkriteria' => $row->subkriteria,
                    'kriteria' => $kriteria ? $kriteria->nama . ' (' . $kriteria->keterangan . ')' : 'N/A',
                    'nilai' => $row->nilai,
                ];
            }
            return DataTables::of($rowData)->toJson();
        }

        return view('pages.kriteria.subkriteria.index', ['kriteria' => $kriteria]);
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
        $validator = Validator::make($request->all(), [
            'subkriteria' => 'required',
            'kriteria' => 'required',
            'nilai' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kriteria = Kriteria::find($request->kriteria);
        $nama = $kriteria->nama;

        $detail = new Subkriteria();
        $detail->id_kriteria = $request->kriteria;
        $detail->subkriteria = $request->subkriteria;
        $detail->kriteria = $nama;
        $detail->nilai = $request->nilai;
        $detail->save();

        return redirect()->route('admin.subkriteria')->with('success', 'Data subkriteria berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request)
    {
        $id = $request->kriteria;
        $kriteria = Kriteria::find($id);

        if (!$kriteria) {
            return back()->withErrors(['error' => 'Kriteria tidak ditemukan. Silahkan coba kembali']);
        }

        $validator = Validator::make($request->all(), [
            'subkriteria' => 'required',
            'kriteria' => 'required',
            'nilai' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kriteria = Kriteria::find($request->kriteria);
        $nama = $kriteria->nama;

        $detail = Subkriteria::where('id_subkriteria', $request->id_subkriteria)->first();
        $detail->id_kriteria = $request->kriteria;
        $detail->subkriteria = $request->subkriteria;
        $detail->nilai = $request->nilai;
        $detail->save();

        return redirect()->route('admin.subkriteria')->with('success', 'Data subkriteria berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kriteria = Subkriteria::find($id);
            $kriteria->delete();
            return response()->json(['message' => 'Data subkriteria berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus data'], 500);
        }
    }
}
