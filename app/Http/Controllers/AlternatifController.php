<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Analisa;
use App\Models\DetailAlternatif;
use App\Models\GameplayType;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriteria = Kriteria::all();
        $detailKriteria = Subkriteria::all();
        $gameplay = GameplayType::all();

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
                    'subkriteria' => $subkriteriaData
                ];
            }

            return DataTables::of($rowData)->toJson();
        }

        return view('pages.alternatif.index', ['kriteria' => $kriteria, 'detailKriteria' => $detailKriteria, 'gameplay' => $gameplay]);
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
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp',
            'nama' => 'required',
            'role' => 'required',
            'laning' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $jumlahDataKriteria = Kriteria::count();

            if ($jumlahDataKriteria == 0) {
                throw new \Exception('Data kriteria masih kosong. Silahkan isi terlebih dahulu.');
            }

            DB::beginTransaction();

            $foto_path = null;
            $file_path_foto = 'uploads/foto';

            if ($request->file('foto')) {
                $foto = $request->file('foto');
                $foto_path = $foto->store($file_path_foto, 'public');
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

            if ($goldLane >= 10 && $roam >= 10 && $jungler >= 10 && $midLane >= 10 && $expLane >= 10) {
                throw new \Exception('Jumlah alternatif di setiap laning sudah maksimal.');
            }

            $alternatif = new Alternatif();
            $alternatif->id_users = Auth::id();
            $alternatif->nama = $request->nama;
            $alternatif->foto = $foto_path;
            $alternatif->role = $request->role;
            $alternatif->laning = $request->laning;

            if (!$alternatif->save()) {
                throw new \Exception('Gagal menyimpan data alternatif. Silahkan coba kembali.');
            }

            foreach ($request->all() as $key => $value) {
                if (strpos($key, '_kriteria') !== false) {
                    $kriteriaNama = str_replace('_', ' ', preg_replace("/_kriteria$/", "", $key));
                    $kriteria = Kriteria::where('nama', $kriteriaNama)->first();
                    if ($kriteria) {
                        $detailAlternatif = new DetailAlternatif();
                        $detailAlternatif->id_alternatif = $alternatif->id_alternatif;
                        $detailAlternatif->id_kriteria = $kriteria->id_kriteria;
                        $detailAlternatif->id_subkriteria = $value;
                        if (!$detailAlternatif->save()) {
                            throw new \Exception('Gagal menyimpan detail alternatif.');
                        }
                    } else {
                        throw new \Exception('Kriteria tidak ditemukan. Silahkan coba kembali.');
                    }
                }
            }

            DB::commit();

            if (Auth::user()->id_role == 1) {
                return redirect()->route('admin.alternatif')->with('success', 'Data alternatif berhasil ditambahkan.');
            } else {
                return redirect()->route('alternatif')->with('success', 'Data alternatif berhasil ditambahkan.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
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
        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'nama' => 'required',
            'role' => 'required',
            'laning' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $alternatif = Alternatif::find($request->id_alternatif);

            if (!$alternatif) {
                throw new \Exception('Alternatif tidak ditemukan. Silahkan coba kembali.');
            }

            DB::beginTransaction();

            $foto_path = $alternatif->foto;
            $file_path_foto = 'uploads/foto';

            if ($request->hasFile('foto')) {
                if ($foto_path) {
                    Storage::disk('public')->delete($foto_path);
                }

                $foto = $request->file('foto');
                $foto_path = $foto->store($file_path_foto, 'public');
            }

            $alternatif->nama = $request->nama;
            $alternatif->foto = $foto_path;
            $alternatif->role = $request->role;
            $alternatif->laning = $request->laning;

            if ($alternatif->save()) {
                DetailAlternatif::where('id_alternatif', $alternatif->id_alternatif)->delete();

                foreach ($request->all() as $key => $value) {
                    if (strpos($key, '_kriteria') !== false) {
                        $kriteriaNama = str_replace('_', ' ', preg_replace("/_kriteria$/", "", $key));
                        $kriteria = Kriteria::where('nama', $kriteriaNama)->first();
                        if ($kriteria) {
                            $detailAlternatif = new DetailAlternatif();
                            $detailAlternatif->id_alternatif = $alternatif->id_alternatif;
                            $detailAlternatif->id_kriteria = $kriteria->id_kriteria;
                            $detailAlternatif->id_subkriteria = $value;
                            if (!$detailAlternatif->save()) {
                                throw new \Exception('Gagal menyimpan detail hero.');
                            }
                        } else {
                            throw new \Exception('Kriteria tidak ditemukan. Silahkan coba kembali.');
                        }
                    }
                }
            } else {
                throw new \Exception('Gagal menyimpan data hero. Silahkan coba kembali.');
            }

            DB::commit();

            if (Auth::user()->id_role == 1) {
                return redirect()->route('admin.alternatif')->with('success', 'Data alternatif berhasil diperbarui.');
            } else {
                return redirect()->route('alternatif')->with('success', 'Data alternatif berhasil diperbarui.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $alternatif = Alternatif::where('id_alternatif', $id)->first();
            $alternatif->delete();
            return response()->json(['message' => 'Data alternatif berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus data'], 500);
        }
    }
}
