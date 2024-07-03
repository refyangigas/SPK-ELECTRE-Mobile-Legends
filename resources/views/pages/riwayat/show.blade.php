@extends('layout.main')

@section('title', 'Riwayat Hasil Analisa')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12 d-flex justify-content-start">
                        <h1 class="m-0">Riwayat Hasil Analisa Electre Strategi {{ $gameplay->nama }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        {{-- gold lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Rekomendasi Hero Gold Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableGoldLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Foto</th>
                                            <th>Nama Hero</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            <th>Nilai</th>
                                            <th>Rangking</th>
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
                                <h3 class="card-title">Rekomendasi Hero Mid Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMidLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Foto</th>
                                            <th>Nama Hero</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            <th>Nilai</th>
                                            <th>Rangking</th>
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
                                <h3 class="card-title">Rekomendasi Hero EXP Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableEXPLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Foto</th>
                                            <th>Nama Hero</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            <th>Nilai</th>
                                            <th>Rangking</th>
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
                                <h3 class="card-title">Rekomendasi Hero Roam</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableRoam" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Foto</th>
                                            <th>Nama Hero</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            <th>Nilai</th>
                                            <th>Rangking</th>
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
                                <h3 class="card-title">Rekomendasi Hero Jungle</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableJungle" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Foto</th>
                                            <th>Nama Hero</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            <th>Nilai</th>
                                            <th>Rangking</th>
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
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}'
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Oopss...',
                text: '{{ $errors->first() }}'
            });
        </script>
    @endif

    @if (Auth::user()->id_role == 1)
        <script>
            $(document).ready(function() {
                $("#myTableGoldLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.riwayat.show', ['id' => ':id']) }}'.replace(':id', window.location
                            .href.split('/').pop()),
                        method: 'GET',
                        dataSrc: 'data',
                        data: {
                            laning: 'Gold Lane'
                        }
                    },
                    columns: [{
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                if (data == '') {
                                    return '<img src="{{ asset('dist/img/LOGO POLITEKNIK NEGERI  JEMBER.png') }}" alt="" style="width: 50px; height: 50px;">';
                                } else {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
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
                        {
                            data: 'nilai',
                            name: 'nilai'
                        },
                        {
                            data: 'rangking',
                            name: 'rangking'
                        }
                    ],
                    order: [
                        [5, 'asc']
                    ]
                });

                $("#myTableMidLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.riwayat.show', ['id' => ':id']) }}'.replace(':id', window.location
                            .href.split('/').pop()),
                        method: 'GET',
                        dataSrc: 'data',
                        data: {
                            laning: 'Mid Lane'
                        }
                    },
                    columns: [{
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                if (data == '') {
                                    return '<img src="{{ asset('dist/img/LOGO POLITEKNIK NEGERI  JEMBER.png') }}" alt="" style="width: 50px; height: 50px;">';
                                } else {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
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
                        {
                            data: 'nilai',
                            name: 'nilai'
                        },
                        {
                            data: 'rangking',
                            name: 'rangking'
                        }
                    ],
                    order: [
                        [5, 'asc']
                    ]
                });

                $("#myTableEXPLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.riwayat.show', ['id' => ':id']) }}'.replace(':id', window.location
                            .href.split('/').pop()),
                        method: 'GET',
                        dataSrc: 'data',
                        data: {
                            laning: 'EXP Lane'
                        }
                    },
                    columns: [{
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                if (data == '') {
                                    return '<img src="{{ asset('dist/img/LOGO POLITEKNIK NEGERI  JEMBER.png') }}" alt="" style="width: 50px; height: 50px;">';
                                } else {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
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
                        {
                            data: 'nilai',
                            name: 'nilai'
                        },
                        {
                            data: 'rangking',
                            name: 'rangking'
                        }
                    ],
                    order: [
                        [5, 'asc']
                    ]
                });

                $("#myTableRoam").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.riwayat.show', ['id' => ':id']) }}'.replace(':id', window
                            .location
                            .href.split('/').pop()),
                        method: 'GET',
                        dataSrc: 'data',
                        data: {
                            laning: 'Roam'
                        }
                    },
                    columns: [{
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                if (data == '') {
                                    return '<img src="{{ asset('dist/img/LOGO POLITEKNIK NEGERI  JEMBER.png') }}" alt="" style="width: 50px; height: 50px;">';
                                } else {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
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
                        {
                            data: 'nilai',
                            name: 'nilai'
                        },
                        {
                            data: 'rangking',
                            name: 'rangking'
                        }
                    ],
                    order: [
                        [5, 'asc']
                    ]
                });

                $("#myTableJungle").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.riwayat.show', ['id' => ':id']) }}'.replace(':id', window
                            .location
                            .href.split('/').pop()),
                        method: 'GET',
                        dataSrc: 'data',
                        data: {
                            laning: 'Jungle'
                        }
                    },
                    columns: [{
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                if (data == '') {
                                    return '<img src="{{ asset('dist/img/LOGO POLITEKNIK NEGERI  JEMBER.png') }}" alt="" style="width: 50px; height: 50px;">';
                                } else {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
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
                        {
                            data: 'nilai',
                            name: 'nilai'
                        },
                        {
                            data: 'rangking',
                            name: 'rangking'
                        }
                    ],
                    order: [
                        [5, 'asc']
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
                        url: '{{ route('riwayat.show', ['id' => ':id']) }}'.replace(':id', window
                            .location
                            .href.split('/').pop()),
                        method: 'GET',
                        dataSrc: 'data',
                        data: {
                            laning: 'Gold Lane'
                        }
                    },
                    columns: [{
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                if (data == '') {
                                    return '<img src="{{ asset('dist/img/LOGO POLITEKNIK NEGERI  JEMBER.png') }}" alt="" style="width: 50px; height: 50px;">';
                                } else {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
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
                        {
                            data: 'nilai',
                            name: 'nilai'
                        },
                        {
                            data: 'rangking',
                            name: 'rangking'
                        }
                    ],
                    order: [
                        [5, 'asc']
                    ]
                });

                $("#myTableMidLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('riwayat.show', ['id' => ':id']) }}'.replace(':id', window
                            .location
                            .href.split('/').pop()),
                        method: 'GET',
                        dataSrc: 'data',
                        data: {
                            laning: 'Mid Lane'
                        }
                    },
                    columns: [{
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                if (data == '') {
                                    return '<img src="{{ asset('dist/img/LOGO POLITEKNIK NEGERI  JEMBER.png') }}" alt="" style="width: 50px; height: 50px;">';
                                } else {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
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
                        {
                            data: 'nilai',
                            name: 'nilai'
                        },
                        {
                            data: 'rangking',
                            name: 'rangking'
                        }
                    ],
                    order: [
                        [5, 'asc']
                    ]
                });

                $("#myTableEXPLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('riwayat.show', ['id' => ':id']) }}'.replace(':id', window
                            .location
                            .href.split('/').pop()),
                        method: 'GET',
                        dataSrc: 'data',
                        data: {
                            laning: 'EXP Lane'
                        }
                    },
                    columns: [{
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                if (data == '') {
                                    return '<img src="{{ asset('dist/img/LOGO POLITEKNIK NEGERI  JEMBER.png') }}" alt="" style="width: 50px; height: 50px;">';
                                } else {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
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
                        {
                            data: 'nilai',
                            name: 'nilai'
                        },
                        {
                            data: 'rangking',
                            name: 'rangking'
                        }
                    ],
                    order: [
                        [5, 'asc']
                    ]
                });

                $("#myTableRoam").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('riwayat.show', ['id' => ':id']) }}'.replace(':id', window
                            .location
                            .href.split('/').pop()),
                        method: 'GET',
                        dataSrc: 'data',
                        data: {
                            laning: 'Roam'
                        }
                    },
                    columns: [{
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                if (data == '') {
                                    return '<img src="{{ asset('dist/img/LOGO POLITEKNIK NEGERI  JEMBER.png') }}" alt="" style="width: 50px; height: 50px;">';
                                } else {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
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
                        {
                            data: 'nilai',
                            name: 'nilai'
                        },
                        {
                            data: 'rangking',
                            name: 'rangking'
                        }
                    ],
                    order: [
                        [5, 'asc']
                    ]
                });

                $("#myTableJungle").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('riwayat.show', ['id' => ':id']) }}'.replace(':id', window
                            .location
                            .href.split('/').pop()),
                        method: 'GET',
                        dataSrc: 'data',
                        data: {
                            laning: 'Jungle'
                        }
                    },
                    columns: [{
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                if (data == '') {
                                    return '<img src="{{ asset('dist/img/LOGO POLITEKNIK NEGERI  JEMBER.png') }}" alt="" style="width: 50px; height: 50px;">';
                                } else {
                                    return '<img src="{{ asset('storage') }}/' + data +
                                        '" alt="" style="width: 50px; height: 50px;">';
                                }
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
                        {
                            data: 'nilai',
                            name: 'nilai'
                        },
                        {
                            data: 'rangking',
                            name: 'rangking'
                        }
                    ],
                    order: [
                        [5, 'asc']
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
        </script>
    @endif
@endsection
