@extends('layout.main')

@section('title', 'Kriteria')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Kriteria</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Kriteria</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-gameplay">
                                        <i class="fas fa-plus"></i> Strategi
                                    </button>
                                    <div class="modal fade" id="modal-gameplay">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Tambah Data Strategi</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.kriteria.store') }}" method="POST">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="nama_gameplay">Nama Strategi</label>
                                                                <input type="text" class="form-control"
                                                                    name="nama_gameplay" id="nama_gameplay"
                                                                    placeholder="Nama gameplay">
                                                            </div>
                                                            @foreach ($kriteria as $item)
                                                                <div class="form-group">
                                                                    <label for="{{ $item->nama }}_bobot">Bobot
                                                                        {{ $item->nama }}</label>
                                                                    <input type="number" class="form-control"
                                                                        name="{{ $item->nama }}_bobot"
                                                                        id="{{ $item->nama }}_bobot"
                                                                        placeholder="Masukkan Bobot {{ $item->nama }}"
                                                                        min="1" max="10">
                                                                </div>
                                                            @endforeach
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
                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                        data-target="#modal-kriteria">
                                        <i class="fas fa-plus"></i>
                                        Kriteria
                                    </button>
                                    <div class="modal fade" id="modal-kriteria">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Tambah Data Kriteria</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.kriteria.store') }}" method="POST">
                                                        @csrf
                                                        <div class="card-body">
                                                            <input type="hidden" class="form-control" name="add_kriteria"
                                                                id="add_kriteria" value="add_kriteria">
                                                            <div class="form-group">
                                                                <label for="nama_kriteria">Nama Kriteria</label>
                                                                <input type="text" class="form-control"
                                                                    name="nama_kriteria" id="nama_kriteria"
                                                                    placeholder="Nama Kriteria">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="keterangan_kriteria">Keterangan Kriteria</label>
                                                                <input type="text" class="form-control"
                                                                    name="keterangan_kriteria" id="keterangan_kriteria"
                                                                    placeholder="Keterangan Kriteria">
                                                            </div>
                                                            @foreach ($gameplay as $item)
                                                                <div class="form-group">
                                                                    <label for="{{ $item->nama }}_bobot">Bobot
                                                                        {{ $item->nama }}</label>
                                                                    <input type="number" class="form-control"
                                                                        name="{{ $item->nama }}_bobot"
                                                                        id="{{ $item->nama }}_bobot"
                                                                        placeholder="Masukkan Bobot {{ $item->nama }}"
                                                                        min="1" max="10">
                                                                </div>
                                                            @endforeach
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
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Tipe Strategi</th>
                                            @foreach ($kriteria as $k)
                                                <th>Bobot {{ $k->nama }} ({{ $k->keterangan }})</th>
                                            @endforeach
                                            <th class="w-10">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($gameplay as $g)
                                            <tr>
                                                <td>{{ $g->nama }}</td>
                                                @foreach ($kriteria as $k)
                                                    <td>{{ $bobot[$g->id_gameplay][$k->id_kriteria] ?? 'N/A' }}</td>
                                                @endforeach
                                                <td>
                                                    <div class="row justify-content-center">
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-warning m-1"
                                                                data-toggle="modal"
                                                                data-target="#modal-edit-gameplay-{{ $g->id_gameplay }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger m-1"
                                                                onclick="confirmDeleteGameplay({{ $g->id_gameplay }})"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="text-center">
                                        <tr>
                                            <th>Tipe Strategi</th>
                                            @foreach ($kriteria as $k)
                                                <th>
                                                    <button type="button" class="btn btn-warning m-1"
                                                        data-toggle="modal"
                                                        data-target="#modal-edit-kriteria-{{ $k->id_kriteria }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger m-1"
                                                        onclick="confirmDeleteKriteria({{ $k->id_kriteria }})"><i
                                                            class="fas fa-trash"></i></button>
                                                </th>
                                            @endforeach
                                            <th>Opsi</th>
                                        </tr>
                                    </tfoot>
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

            @foreach ($gameplay as $type)
                <div class="modal fade" id="modal-edit-gameplay-{{ $type->id_gameplay }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Data Strategi</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.kriteria.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <input type="hidden" name="id_gameplay"
                                            id="id_gameplay_{{ $type->id_gameplay }}" value="{{ $type->id_gameplay }}">
                                        <div class="form-group">
                                            <label for="nama_{{ $type->id_gameplay }}">Strategi</label>
                                            <input type="text" class="form-control" name="nama_gameplay"
                                                id="nama_{{ $type->id_gameplay }}" value="{{ $type->nama }}">
                                        </div>
                                        <hr>
                                        @foreach ($kriteria as $item)
                                            <div class="form-group">
                                                <label for="{{ $item->nama }}_bobot">Bobot
                                                    {{ $item->nama }}</label>
                                                <input type="number" class="form-control"
                                                    name="{{ $item->nama }}_bobot" id="{{ $item->nama }}_bobot"
                                                    placeholder="Masukkan Bobot {{ $item->nama }}" required
                                                    min="1" max="10">
                                            </div>
                                        @endforeach
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
            @endforeach

            @foreach ($kriteria as $type)
                <div class="modal fade" id="modal-edit-kriteria-{{ $type->id_kriteria }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Data Kriteria</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.kriteria.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <input type="hidden" name="id_kriteria"
                                            id="id_kriteria_{{ $type->id_kriteria }}" value="{{ $type->id_kriteria }}">
                                        <div class="form-group">
                                            <label for="nama_{{ $type->id_kriteria }}">Kriteria</label>
                                            <input type="text" class="form-control" name="nama_kriteria"
                                                id="nama_{{ $type->id_kriteria }}" value="{{ $type->nama }}">
                                        </div>
                                        <hr>
                                        <label for="keterangan_kriteria_{{ $type->id_kriteria }}">Keterangan
                                            Kriteria</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="keterangan"
                                                value="{{ $type->keterangan }}"
                                                id="keterangan_kriteria_{{ $type->id_kriteria }}]">
                                        </div>
                                        <hr>
                                        @foreach ($gameplay as $item)
                                            <div class="form-group">
                                                <label for="{{ $item->nama }}_bobot">Bobot
                                                    {{ $item->nama }}</label>
                                                <input type="number" class="form-control"
                                                    name="{{ $item->nama }}_bobot" id="{{ $item->nama }}_bobot"
                                                    placeholder="Masukkan Bobot {{ $item->nama }}" required
                                                    min="1" max="10">
                                            </div>
                                        @endforeach
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
            @endforeach

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
                icon: 'error',
                title: 'Oopss...',
                text: '{{ $errors->first() }}'
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $("#myTable").DataTable({});
            $('#modal-edit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id_kriteria = button.data('id');
                var nama = button.data('nama');
                var bobot = button.data('bobot');
                var keterangan = button.data('keterangan');
                var modal = $(this);

                modal.find('.modal-body #id_kriteria').val(id_kriteria);
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #bobot').val(bobot);
                modal.find('.modal-body #keterangan').val(keterangan);
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

        function confirmDeleteGameplay(id) {
            Swal.fire({
                title: 'Apakah Anda yakin menghapus data strategi?',
                text: "Anda tidak akan dapat mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/gameplay') }}/" + id,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            window.location.reload();
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil dihapus.',
                                'success'
                            );
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data. Silahkan coba lagi',
                                'error'
                            );
                        }
                    });
                }
            });
        }

        function confirmDeleteKriteria(id) {
            Swal.fire({
                title: 'Apakah Anda yakin menghapus data kriteria?',
                text: "Anda tidak akan dapat mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/kriteria') }}/" + id,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            window.location.reload();
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil dihapus.',
                                'success'
                            );
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data. Silahkan coba lagi',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endsection
