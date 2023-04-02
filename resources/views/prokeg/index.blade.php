@extends('master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <h1>List Program Kegiatan</h1>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Kegiatan</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-10">
                            <a href="{{ route('prokeg.create') }}" class="btn btn-primary mb-4">Tambah</a>
                        </div>
                        <div class="col-2 right">
                            <a href="{{ route('prokeg.print') }}" class="btn btn-primary mb-4">Export to Word</a>
                        </div>
                        <form method="GET">
                            <div class="form-group row">
                                <div class="col-sm">
                                    <label for="cari" class="col-sm2 col-form-label">Cari Data</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group mb-3">
                                        <input type="text" name="cari" class="form-control"
                                            placeholder="Cari Program Kegiatan">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Cari</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <a href="{{ route('prokeg') }}" class="btn btn-secondary">Refresh</a>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-stripped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>@sortablelink('nama_program', 'Nama Program')</th>
                                        <th>@sortablelink('status', 'Status')</th>
                                        <th>@sortablelink('tanggal_mulai', 'Tanggal Mulai')</th>
                                        <th>@sortablelink('tanggal_selesai', 'Tanggal Selesai')</th>
                                        <th style="width: 500px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1 + ($prokeg->currentPage() - 1) * $prokeg->perPage();
                                    @endphp
                                    @foreach ($prokeg as $item => $value)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $value->nama_program }}</td>
                                            <td>{{ $value->status }}</td>
                                            <td>{{ $value->tanggal_mulai }}</td>
                                            <td>{{ $value->tanggal_selesai }}</td>
                                            <td>
                                                <a href="{{ route('prokeg.edit', $value->id) }}"
                                                    class="btn btn-warning">Edit</a> |
                                                <a href="javascript:void(0)" data-id="{{ $value->id }}"
                                                    class="btn btn-danger btn-delete">Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {!! $prokeg->appends(Request::except('page'))->render() !!}
                </div>
                <!-- /.card-footer-->
            </div>
        </section>
    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.btn-delete').on('click', function(e) {
                var id = $(this).data('id');
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Terhapus!',
                            'Data berhasil dihapus.',
                            'success'
                        ).then((result) => {
                            $.ajax({
                                type: "delete",
                                url: "{{ route('prokeg') }}/" + "destroy/" + id,
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    location.reload();
                                }
                            });
                        })
                    }
                });
            });
        });
    </script>
@endpush
