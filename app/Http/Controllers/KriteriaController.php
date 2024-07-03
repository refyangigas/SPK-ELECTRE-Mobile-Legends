<?php

namespace App\Http\Controllers;

use App\Models\BobotKriteria;
use App\Models\GameplayType;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriteria = Kriteria::all();
        $gameplay = GameplayType::all();
        $bobot = BobotKriteria::all()->groupBy('id_gameplay')->map(function ($group) {
            return $group->pluck('bobot', 'id_kriteria');
        });

        if ($request->ajax()) {
            return DataTables::of($bobot)->toJson();
        }

        return view('pages.kriteria.index', ['kriteria' => $kriteria, 'gameplay' => $gameplay, 'bobot' => $bobot]);
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
        if ($request->add_kriteria) {
            $validator = Validator::make($request->all(), [
                'nama_kriteria' => 'required',
                'keterangan_kriteria' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            try {
                $jumlahDataGameplay = GameplayType::count();

                if ($jumlahDataGameplay == 0) {
                    throw new \Exception('Data gameplay masih kosong. Silahkan isi terlebih dahulu.');
                }

                DB::beginTransaction();

                $kriteria = new Kriteria();
                $kriteria->nama = $request->nama_kriteria;
                $kriteria->keterangan = $request->keterangan_kriteria;

                if ($kriteria->save()) {
                    foreach ($request->all() as $key => $value) {
                        if (strpos($key, '_bobot') !== false) {
                            $gameplayNama = str_replace('_', ' ', preg_replace("/_bobot$/", "", $key));
                            $gameplay = GameplayType::where('nama', $gameplayNama)->first();
                            if ($gameplay) {
                                $gameplayId = $gameplay->id_gameplay;
                                $kriteriaId = $kriteria->id_kriteria;
                                $bobot = $value;

                                $bobotKriteria = new BobotKriteria();
                                $bobotKriteria->id_kriteria = $kriteriaId;
                                $bobotKriteria->id_gameplay = $gameplayId;
                                $bobotKriteria->bobot = $bobot;
                                if (!$bobotKriteria->save()) {
                                    throw new \Exception('Gagal menyimpan bobot kriteria.');
                                }
                            } else {
                                throw new \Exception('Gameplay tidak ditemukan. Silahkan coba kembali.');
                            }
                        }
                    }
                } else {
                    throw new \Exception('Gagal menyimpan data kriteria. Silahkan coba kembali.');
                }

                DB::commit();

                return redirect()->route('admin.kriteria')->with('success', 'Data kriteria berhasil ditambahkan.');
            } catch (\Exception $e) {
                DB::rollback();
                return back()->withErrors(['error' => $e->getMessage()]);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'nama_gameplay' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            try {

                DB::beginTransaction();

                $gameplay = new GameplayType();
                $gameplay->nama = $request->nama_gameplay;

                if ($gameplay->save()) {
                    foreach ($request->all() as $key => $value) {
                        if (strpos($key, '_bobot') !== false) {
                            $kriteriaNama = str_replace('_', ' ', preg_replace("/_bobot$/", "", $key));
                            $kriteria = Kriteria::where('nama', $kriteriaNama)->first();
                            if ($kriteria) {
                                $kriteriaId = $kriteria->id_kriteria;
                                $gameplayId = $gameplay->id_gameplay;
                                $bobot = $value;

                                $bobotKriteria = new BobotKriteria();
                                $bobotKriteria->id_kriteria = $kriteriaId;
                                $bobotKriteria->id_gameplay = $gameplayId;
                                $bobotKriteria->bobot = $bobot;
                                if (!$bobotKriteria->save()) {
                                    throw new \Exception('Gagal menyimpan bobot kriteria.');
                                }
                            } else {
                                throw new \Exception('Kriteria tidak ditemukan. Silahkan coba kembali.');
                            }
                        }
                    }
                } else {
                    throw new \Exception('Gagal menyimpan data strategi. Silahkan coba kembali.');
                }

                DB::commit();

                return redirect()->route('admin.kriteria')->with('success', 'Data strategi berhasil ditambahkan.');
            } catch (\Exception $e) {
                DB::rollback();
                return back()->withErrors(['error' => $e->getMessage()]);
            }
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
        if ($request->id_gameplay) {
            $validator = Validator::make($request->all(), [
                'id_gameplay' => 'required|exists:gameplay_type,id_gameplay',
                'nama_gameplay' => 'required|string|max:255'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            try {
                DB::beginTransaction();

                $gameplay = GameplayType::findOrFail($request->id_gameplay);
                $gameplay->nama = $request->nama_gameplay;

                if ($gameplay->save()) {
                    BobotKriteria::where('id_gameplay', $gameplay->id_gameplay)->delete();
                    foreach ($request->all() as $key => $value) {
                        if (strpos($key, '_bobot') !== false) {
                            $kriteriaNama = str_replace('_', ' ', preg_replace("/_bobot$/", "", $key));
                            $kriteria = Kriteria::where('nama', $kriteriaNama)->first();
                            if ($kriteria) {
                                $gameplayId = $gameplay->id_gameplay;
                                $kriteriaId = $kriteria->id_kriteria;
                                $bobot = $value;

                                $bobotKriteria = new BobotKriteria();
                                $bobotKriteria->id_kriteria = $kriteriaId;
                                $bobotKriteria->id_gameplay = $gameplayId;
                                $bobotKriteria->bobot = $bobot;
                                if (!$bobotKriteria->save()) {
                                    throw new \Exception('Gagal menyimpan bobot kriteria.');
                                }
                            } else {
                                throw new \Exception('Gameplay tidak ditemukan. Silahkan coba kembali.');
                            }
                        }
                    }
                } else {
                    throw new \Exception('Gagal menyimpan nama strategi.');
                }

                DB::commit();

                return redirect()->route('admin.kriteria')->with('success', 'Data strategi berhasil diperbarui.');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'id_kriteria' => 'required|exists:kriteria,id_kriteria',
                'nama_kriteria' => 'required|string|max:255',
                'keterangan' => 'required|string|max:255'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            try {
                DB::beginTransaction();

                $kriteria = Kriteria::findOrFail($request->id_kriteria);
                $kriteria->nama = $request->nama_kriteria;
                $kriteria->keterangan = $request->keterangan;

                if ($kriteria->save()) {
                    BobotKriteria::where('id_kriteria', $kriteria->id_kriteria)->delete();
                    foreach ($request->all() as $key => $value) {
                        if (strpos($key, '_bobot') !== false) {
                            $gameplayNama = str_replace('_', ' ', preg_replace("/_bobot$/", "", $key));
                            $gameplay = GameplayType::where('nama', $gameplayNama)->first();
                            if ($gameplay) {
                                $gameplayId = $gameplay->id_gameplay;
                                $kriteriaId = $kriteria->id_kriteria;
                                $bobot = $value;

                                $bobotKriteria = new BobotKriteria();
                                $bobotKriteria->id_kriteria = $kriteriaId;
                                $bobotKriteria->id_gameplay = $gameplayId;
                                $bobotKriteria->bobot = $bobot;
                                if (!$bobotKriteria->save()) {
                                    throw new \Exception('Gagal menyimpan bobot kriteria.');
                                }
                            } else {
                                throw new \Exception('Strategi tidak ditemukan. Silahkan coba kembali.');
                            }
                        }
                    }
                } else {
                    throw new \Exception('Gagal menyimpan nama kriteria.');
                }

                DB::commit();

                return redirect()->route('admin.kriteria')->with('success', 'Data kriteria berhasil diperbarui.');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyStrategi(string $id)
    {
        try {
            $gameplay = GameplayType::findOrFail($id);
            $gameplay->delete();
            return response()->json(['message' => 'Data gameplay berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus data'], 500);
        }
    }

    public function destroyKriteria(string $id)
    {
        try {
            $kriteria = Kriteria::findOrFail($id);
            $kriteria->delete();
            return response()->json(['message' => 'Data kriteria berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus data'], 500);
        }
    }
}
