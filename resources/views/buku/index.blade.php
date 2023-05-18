@extends('master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <h1>Buku</h1>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pendataan Buku</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <form method="GET">
                    <div class="form-group row">
                        <div class="col-sm text-center mt-3">
                            <label for="cari" class="col-sm2 col-form-label">Cari Buku</label>
                        </div>
                        <div class="col-sm-9 mt-3">
                            <div class="input-group mb-3">
                                <input type="text" name="cari" class="form-control"
                                    placeholder="Cari Buku">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm mt-3">
                            <a href="{{ route('buku') }}" class="btn btn-secondary">Refresh</a>
                        </div>
                    </div>
                <div class="card-body">
                    <a href="{{ route('buku.create') }}" class="btn btn-primary mb-4">Tambah Buku</a>
                    <table class="table table-bordered table-hover table-responsive-lg table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Untuk Kelas</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>Jenis Buku</th>
                                <th>Jumlah Salinan</th>
                                <th>Kondisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buku as $item => $i)
                                <tr>
                                    <td>{{ $item + 1 }}</td>
                                    <td>{{ $i->judul }}</td>
                                    <td>{{ $i->kelas }}</td>
                                    <td>{{ $i->pengarang }}</td>
                                    <td>{{ $i->penerbit }}</td>
                                    <td>{{ $i->tahunterbit }}</td>
                                    <td>{{ $i->jenisbuku }}</td>
                                    <td>{{ $i->jumlah }}</td>
                                    <td>@if($i->kondisi == 'Rusak') <div class="text-danger">{{$i->kondisi}}</div> @else <div class="text-success">{{$i->kondisi}}</div> @endif</td>
                                    <td>
                                        <a href="{{ route('buku') }}/{{ $i->id }}/edit"
                                            class="btn btn-warning">Edit</a>
                                        <a href="javascript:void(0)" class="btn btn-danger deleteBuku"
                                            data-id="{{ $i->id }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {!! $buku->appends(Request::except('page'))->render() !!}
                </div>
                <!-- /.card-footer-->

            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/sweetalert2/sweetalert2.min.css">
@endpush

@push('js')
    <script src="{{ asset('adminlte') }}/plugins/sweetalert2/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.deleteBuku').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Kamu Yakin?',
                    text: "Hati-Hati Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus Data'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Terhapus!',
                            'Data berhasil dihapus.',
                            'success'
                        ).then((result) => {
                            $.ajax({
                                url: "{{ route('buku') }}" + "/" + id + "/delete",
                                type: 'DELETE',
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    location.reload();
                                }
                            });
                        })
                    }
                })
            });
        });
    </script>
@endpush
