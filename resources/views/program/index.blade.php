@extends('master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <h1>List Program Perpustakaan</h1>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Program</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form method="GET">

                        <div class="row">
                            @foreach ($years as $item => $value)
                                <div class="col-1">
                                    <input type="hidden">
                                    <button type="submit" name="year" value="{{ $value->year }}"
                                        class="btn btn-primary mb-4">{{ $value->year }}</button>
                                </div>
                            @endforeach
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-10">
                            <a href="{{ route('program.create') }}" class="btn btn-primary mb-4">Tambah</a>
                        </div>
                        <div class="col-2 right">
                            {{-- <a href="{{ route('program.print') }}" class="btn btn-success mb-4">Export</a> --}}
                            <button type="button" class="btn btn-success mb-4" data-toggle="modal" data-target="#exportModal">
                                Export
                            </button>
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
                                    <a href="{{ route('program') }}" class="btn btn-secondary">Refresh</a>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>@sortablelink('jenis_program', 'Jenis Program')</th>
                                            <th>@sortablelink('jenis_kegiatan', 'Jenis Kegiatan')</th>
                                            <th>@sortablelink('waktu_pelaksanaan', 'Waktu Pelaksanaan')</th>
                                            <th>@sortablelink('waktu_selesai', 'Waktu Selesai')</th>
                                            <th>@sortablelink('keterangan', 'Keterangan')</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1 + ($program->currentPage() - 1) * $program->perPage();
                                        @endphp
                                        @foreach ($program as $item => $value)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $value->jenis_program }}</td>
                                                <td>
                                                    @php
                                                        $jenis_kegiatan = explode(',', $value->jenis_kegiatan);
                                                        $no = 1;
                                                    @endphp
                                                    @foreach ($jenis_kegiatan as $item)
                                                        {{ $no++ }}. {{ $item }} <br>
                                                    @endforeach
                                                </td>
                                                <td>{{ $value->waktu_kegiatan }}
                                                </td>
                                                @if ($value->waktu_selesai == null)
                                                    <td> {{ $value->waktu_kegiatan }} </td>
                                                @else
                                                    <td>{{ $value->waktu_selesai }}
                                                    </td>
                                                @endif
                                                <td>{{ $value->keterangan }}</td>
                                                <td>
                                                    <a href="{{ route('program.edit', $value->id) }}"
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
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {!! $program->appends(Request::except('page'))->render() !!}
                </div>
                <!-- /.card-footer-->
            </div>
        </section>
    </div>
    @include('program.modal.index')
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
                                url: "{{ route('program') }}/" + "destroy/" + id,
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
