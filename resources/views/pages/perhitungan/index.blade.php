@extends('layout.main')

@section('subtitle', 'Perhitungan')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12 d-flex justify-content-start">
                        <h1 class="m-0">Perhitungan</h1>
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex justify-content-end">
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-gameplay">
                                <i class="fas fa-book"></i> Strategi
                            </button>
                            <div class="modal fade" id="modal-gameplay">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ganti Strategi</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @if (Auth::user()->id_role == 1)
                                                <form action="{{ route('admin.perhitungan.store') }}" method="POST">
                                                    @csrf
                                                @else
                                                    <form action="{{ route('perhitungan.store') }}" method="POST">
                                                        @csrf
                                            @endif
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="gameplay">Strategi Permainan</label>
                                                    <select class="form-control select2" style="width: 100%;"
                                                        name="gameplay" id="gameplay">
                                                        <option value="" selected disabled>Pilih Strategi
                                                        </option>
                                                        @foreach ($gameplay as $item)
                                                            <option value="{{ $item->id_gameplay }}">
                                                                {{ $item->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alternatif content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        {{-- gold lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Alternatif Gold Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableGoldLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama Hero</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- mid lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Alternatif Mid Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMidLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama Hero</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- exp lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Alternatif EXP Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableEXPLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama Hero</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- Roam --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Alternatif Roam</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableRoam" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama Hero</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- Jungle --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Alternatif Jungle</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableJungle" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama Hero</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Normalisasi content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        {{-- normalisasi gold lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Normalisasi Gold Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableNormalisasiGoldLane" class="table table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- normalisasi mid lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Normalisasi Mid Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableNormalisasiMidLane" class="table table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- normalisasi exp lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Normalisasi EXP Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableNormalisasiEXPLane" class="table table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- normalisasi roam --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Normalisasi Roam</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableNormalisasiRoam" class="table table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- normalisasi jungle --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Normalisasi Jungle</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableNormalisasiJungle" class="table table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Pembobotan content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        {{-- pembobotan gold lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pembobotan Gold Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTablePembobotanGoldLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- pembobotan mid lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pembobotan Mid Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTablePembobotanMidLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- pembobotan exp lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pembobotan EXP Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTablePembobotanEXPLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- pembobotan roam --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pembobotan Roam</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTablePembobotanRoam" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- pembobotan jungle --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pembobotan Jungle</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTablePembobotanJungle" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Himpunan Concordance content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        {{-- concordance gold lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Concordance Gold Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableConcordanceGoldLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            {{-- <th>Nama Hero</th> --}}
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Kriteria yang Memenuhi</th>
                                            {{-- @foreach ($alternatif_gold_lane as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach --}}

                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        {{-- @foreach ($tableData as $data)
                                            <tr>
                                                <td>{{ $data['nama_hero'] }}</td>
                                                @foreach ($alternatif_gold_lane as $alternatif)
                                                    <td>
                                                        @foreach ($data['true_kriteria'][$alternatif->nama] as $true_kriteria)
                                                            {{ $true_kriteria }}
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- concordance mid lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Concordance Mid Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableConcordanceMidLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            {{-- <th>Nama Hero</th> --}}
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Kriteria yang Memenuhi</th>
                                            {{-- @foreach ($alternatif_gold_lane as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach --}}

                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        {{-- @foreach ($tableData as $data)
                                            <tr>
                                                <td>{{ $data['nama_hero'] }}</td>
                                                @foreach ($alternatif_gold_lane as $alternatif)
                                                    <td>
                                                        @foreach ($data['true_kriteria'][$alternatif->nama] as $true_kriteria)
                                                            {{ $true_kriteria }}
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- concordance exp lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Concordance EXP Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableConcordanceEXPLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            {{-- <th>Nama Hero</th> --}}
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Kriteria yang Memenuhi</th>
                                            {{-- @foreach ($alternatif_gold_lane as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach --}}

                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        {{-- @foreach ($tableData as $data)
                                            <tr>
                                                <td>{{ $data['nama_hero'] }}</td>
                                                @foreach ($alternatif_gold_lane as $alternatif)
                                                    <td>
                                                        @foreach ($data['true_kriteria'][$alternatif->nama] as $true_kriteria)
                                                            {{ $true_kriteria }}
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- concordance roam --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Concordance Roam</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableConcordanceRoam" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            {{-- <th>Nama Hero</th> --}}
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Kriteria yang Memenuhi</th>
                                            {{-- @foreach ($alternatif_gold_lane as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach --}}

                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        {{-- @foreach ($tableData as $data)
                                            <tr>
                                                <td>{{ $data['nama_hero'] }}</td>
                                                @foreach ($alternatif_gold_lane as $alternatif)
                                                    <td>
                                                        @foreach ($data['true_kriteria'][$alternatif->nama] as $true_kriteria)
                                                            {{ $true_kriteria }}
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- concordance jungle --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Concordance Jungle</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableConcordanceJungle" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            {{-- <th>Nama Hero</th> --}}
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Kriteria yang Memenuhi</th>
                                            {{-- @foreach ($alternatif_gold_lane as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach --}}

                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        {{-- @foreach ($tableData as $data)
                                            <tr>
                                                <td>{{ $data['nama_hero'] }}</td>
                                                @foreach ($alternatif_gold_lane as $alternatif)
                                                    <td>
                                                        @foreach ($data['true_kriteria'][$alternatif->nama] as $true_kriteria)
                                                            {{ $true_kriteria }}
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Himpunan Discordance content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        {{-- discordance gold lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Discordance Gold Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableDiscordanceGoldLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Kriteria yang Memenuhi</th>
                                            {{-- @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach --}}
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- discordance mid lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Discordance Mid Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableDiscordanceMidLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Kriteria yang Memenuhi</th>
                                            {{-- @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach --}}
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- discordance exp lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Discordance EXP Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableDiscordanceEXPLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Kriteria yang Memenuhi</th>
                                            {{-- @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach --}}
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- discordance roam --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Discordance Roam</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableDiscordanceRoam" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Kriteria yang Memenuhi</th>
                                            {{-- @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach --}}
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- discordance jungle --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Discordance Jungle</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableDiscordanceJungle" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Kriteria yang Memenuhi</th>
                                            {{-- @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach --}}
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Matriks Concordance content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        {{-- gold lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Concordance Gold Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixConcordanceGoldLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                            {{-- @foreach ($alternatif_gold_lane as $item)
                                                <th>{{ $item->nama_hero }}</th>
                                            @endforeach --}}
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- mid lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Concordance Mid Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixConcordanceMidLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                            {{-- @foreach ($alternatif_gold_lane as $item)
                                                <th>{{ $item->nama_hero }}</th>
                                            @endforeach --}}
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- exp lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Concordance EXP Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixConcordanceEXPLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                            {{-- @foreach ($alternatif_gold_lane as $item)
                                                <th>{{ $item->nama_hero }}</th>
                                            @endforeach --}}
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- roam --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Concordance Roam</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixConcordanceRoam" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                            {{-- @foreach ($alternatif_gold_lane as $item)
                                                <th>{{ $item->nama_hero }}</th>
                                            @endforeach --}}
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- jungle --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Concordance Jungle</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixConcordanceJungle" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                            {{-- @foreach ($alternatif_gold_lane as $item)
                                                <th>{{ $item->nama_hero }}</th>
                                            @endforeach --}}
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Matriks Discordance content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        {{-- gold lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Discordance Gold Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixDiscordanceGoldLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- mid lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Discordance Mid Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixDiscordanceMidLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- exp lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Discordance EXP Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixDiscordanceEXPLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- roam --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Discordance Roam</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixDiscordanceRoam" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- jungle --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Discordance Jungle</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixDiscordanceJungle" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Matriks Dominan Concordance content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        {{-- gold lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Dominan Concordance Gold Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixDominanceConcordanceGoldLane"
                                    class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- mid lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Dominan Concordance Mid Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixDominanceConcordanceMidLane"
                                    class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- exp lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Dominan Concordance EXP Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixDominanceConcordanceEXPLane"
                                    class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- roam --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Dominan Concordance Roam</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixDominanceConcordanceRoam"
                                    class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- jungle --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Dominan Concordance Jungle</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixDominanceConcordanceJungle"
                                    class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Matriks Dominan Discordance content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        {{-- gold lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Dominan Discordance Gold Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixDominanceDiscordanceGoldLane"
                                    class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- mid lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Dominan Discordance Mid Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixDominanceDiscordanceMidLane"
                                    class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- exp lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Dominan Discordance EXP Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixDominanceDiscordanceEXPLane"
                                    class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- roam --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Dominan Discordance Roam</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixDominanceDiscordanceRoam"
                                    class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- jungle --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Dominan Discordance Jungle</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMatrixDominanceDiscordanceJungle"
                                    class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Aggregate Dominan Matriks content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        {{-- gold lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Aggregate Dominan Matriks Gold Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableAggregateMatrixDominanceGoldLane"
                                    class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- mid lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Aggregate Dominan Matriks Mid Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableAggregateMatrixDominanceMidLane"
                                    class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- exp lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Aggregate Dominan Matriks EXP Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableAggregateMatrixDominanceEXPLane"
                                    class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- roam --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Aggregate Dominan Matriks Roam</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableAggregateMatrixDominanceRoam" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- jungle --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Aggregate Dominan Matriks Jungle</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableAggregateMatrixDominanceJungle"
                                    class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        @if (Auth::user()->id_role == 1)
            <script>
                $(document).ready(function() {
                    $("#myTableGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableNormalisasiGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.normalisasi') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableNormalisasiMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.normalisasi') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableNormalisasiEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.normalisasi') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableNormalisasiRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.normalisasi') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableNormalisasiJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.normalisasi') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTablePembobotanGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.pembobotan') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTablePembobotanMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.pembobotan') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTablePembobotanEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.pembobotan') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTablePembobotanRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.pembobotan') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTablePembobotanJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.pembobotan') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableConcordanceGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.concordance') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableConcordanceMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.concordance') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableConcordanceEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.concordance') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableConcordanceRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.concordance') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableConcordanceJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.concordance') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableDiscordanceGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.discordance') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableDiscordanceMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.discordance') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableDiscordanceEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.discordance') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableDiscordanceRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.discordance') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableDiscordanceJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.discordance') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableMatrixConcordanceGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.concordance') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixConcordanceMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.concordance') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixConcordanceEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.concordance') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixConcordanceRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.concordance') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixConcordanceJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.concordance') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDiscordanceGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.discordance') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDiscordanceMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.discordance') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDiscordanceEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.discordance') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDiscordanceRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.discordance') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDiscordanceJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.discordance') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceConcordanceGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.dominance.concordance') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceConcordanceMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.dominance.concordance') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceConcordanceEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.dominance.concordance') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceConcordanceRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.dominance.concordance') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceConcordanceJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.dominance.concordance') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceDiscordanceGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.dominance.discordance') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceDiscordanceMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.dominance.discordance') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceDiscordanceEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.dominance.discordance') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceDiscordanceRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.dominance.discordance') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceDiscordanceJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.matrix.dominance.discordance') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableAggregateMatrixDominanceGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.aggregate.matrix.dominance') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableAggregateMatrixDominanceMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.aggregate.matrix.dominance') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableAggregateMatrixDominanceEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.aggregate.matrix.dominance') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableAggregateMatrixDominanceRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.aggregate.matrix.dominance') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableAggregateMatrixDominanceJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('admin.perhitungan.aggregate.matrix.dominance') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $('.datatable-input').on('input', function() {
                        var searchText = $(this).val().toLowerCase();

                        $('.table tr').each(function() {
                            var rowData = $(this).text().toLowerCase();
                            if (rowData.indexOf(searchText) === -1) {
                                $(this).hide();
                            } else {
                                $(this).show();
                            }
                        });
                    });
                });

                function validateForm() {
                    var selects = document.querySelectorAll('#select2');

                    for (var i = 0; i < selects.length; i++) {
                        if (!selects[i].value) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Mohon pilih semua kriteria sebelum menyimpan.'
                            });
                            return false;
                        }
                    }
                    return true;
                }
            </script>
        @else
            <script>
                $(document).ready(function() {
                    $("#myTableGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableNormalisasiGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.normalisasi') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableNormalisasiMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.normalisasi') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableNormalisasiEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.normalisasi') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableNormalisasiRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.normalisasi') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableNormalisasiJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.normalisasi') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTablePembobotanGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.pembobotan') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTablePembobotanMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.pembobotan') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTablePembobotanEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.pembobotan') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTablePembobotanRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.pembobotan') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTablePembobotanJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.pembobotan') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'foto',
                                name: 'foto',
                                render: function(data) {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'role',
                                name: 'role'
                            },
                            {
                                data: 'laning',
                                name: 'laning'
                            },
                            @foreach ($kriteria as $kriteriaItem)
                                {
                                    data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                    name: '{{ $kriteriaItem->nama }}',
                                    render: function(data) {
                                        return data ? data : 'N/A';
                                    }
                                },
                            @endforeach
                        ],
                        rowCallback: function(row, data, index) {
                            var dt = this.api();
                            $(row).attr('data-id', data.id);
                            $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                        }
                    });

                    $("#myTableConcordanceGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.concordance') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableConcordanceMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.concordance') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableConcordanceEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.concordance') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableConcordanceRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.concordance') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableConcordanceJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.concordance') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableDiscordanceGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.discordance') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableDiscordanceMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.discordance') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableDiscordanceEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.discordance') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableDiscordanceRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.discordance') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableDiscordanceJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.discordance') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'true_kriteria',
                                name: 'true_kriteria'
                            }
                        ]
                    });

                    $("#myTableMatrixConcordanceGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.concordance') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixConcordanceMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.concordance') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixConcordanceEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.concordance') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixConcordanceRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.concordance') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixConcordanceJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.concordance') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDiscordanceGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.discordance') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDiscordanceMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.discordance') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDiscordanceEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.discordance') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDiscordanceRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.discordance') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDiscordanceJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.discordance') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceConcordanceGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.dominance.concordance') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceConcordanceMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.dominance.concordance') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceConcordanceEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.dominance.concordance') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceConcordanceRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.dominance.concordance') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceConcordanceJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.dominance.concordance') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceDiscordanceGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.dominance.discordance') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceDiscordanceMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.dominance.discordance') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceDiscordanceEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.dominance.discordance') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceDiscordanceRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.dominance.discordance') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableMatrixDominanceDiscordanceJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.matrix.dominance.discordance') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableAggregateMatrixDominanceGoldLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.aggregate.matrix.dominance') }}',
                            data: {
                                laning: 'Gold Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableAggregateMatrixDominanceMidLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.aggregate.matrix.dominance') }}',
                            data: {
                                laning: 'Mid Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableAggregateMatrixDominanceEXPLane").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.aggregate.matrix.dominance') }}',
                            data: {
                                laning: 'EXP Lane'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableAggregateMatrixDominanceRoam").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.aggregate.matrix.dominance') }}',
                            data: {
                                laning: 'Roam'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $("#myTableAggregateMatrixDominanceJungle").DataTable({
                        processing: true,
                        ordering: true,
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('perhitungan.aggregate.matrix.dominance') }}',
                            data: {
                                laning: 'Jungle'
                            }
                        },
                        columns: [{
                                data: 'alternatif_1',
                                name: 'alternatif_1'
                            },
                            {
                                data: 'alternatif_2',
                                name: 'alternatif_2'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            }
                        ]
                    });

                    $('.datatable-input').on('input', function() {
                        var searchText = $(this).val().toLowerCase();

                        $('.table tr').each(function() {
                            var rowData = $(this).text().toLowerCase();
                            if (rowData.indexOf(searchText) === -1) {
                                $(this).hide();
                            } else {
                                $(this).show();
                            }
                        });
                    });
                });

                function validateForm() {
                    var selects = document.querySelectorAll('#select2');

                    for (var i = 0; i < selects.length; i++) {
                        if (!selects[i].value) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Mohon pilih semua kriteria sebelum menyimpan.'
                            });
                            return false;
                        }
                    }
                    return true;
                }
            </script>
        @endif
    @endsection
