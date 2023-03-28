@extends('master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <h1>Input Program Kegiatan</h1>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Title</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('prokeg') }}" class="btn btn-primary mb-4">Kembali</a>
                    <form action="{{ route('prokeg.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Nama Program Kegiatan</label>
                            <input type="text" name="name" placeholder="Nama prokeg" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="status">Status Program Kegiatan</label>
                            <input type="text" name="status" placeholder="Nama prokeg" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_mulai">Tanggal Mulai Program Kegiatan</label>
                            <input type="date" name="tanggal_mulai" placeholder="Nama prokeg" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_selesai">Tanggal Selesai Program Kegiatan</label>
                            <input type="date" name="tanggal_selesai" placeholder="Nama prokeg" class="form-control">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
        </section>
    </div>
@endsection

@push('js')
@endpush
