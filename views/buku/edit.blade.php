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
                    <h3 class="card-title">Silahkan Edit Kembali</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('buku') }}" class="btn btn-primary mb-4">Kembali</a>
                    <form action="{{ route('buku.store') }}" method="POST">
                        @csrf
                        <input type="text" id="id" name="id" value="{{ $buku->id }}" hidden>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}">
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Untuk Kelas</label>
                            <select class="form-control" id="kelas" name="kelas" value="{{ $buku->kelas }}">
                                <option value="VII">VII</option>
                                <option value="VIII">VIII</option>
                                <option value="IX">IX</option>
                                <option value="Umum">Umum</option>
                            </select> 
                        </div>
                        <div class="mb-3">
                            <label for="pengarang" class="form-label">Penulis</label>
                            <input type="text" class="form-control" id="pengarang" name="pengarang" value="{{ $buku->pengarang }}">
                        </div>
                        <div class="mb-3">
                            <label for="penerbit" class="form-label">Penerbit Buku</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $buku->penerbit }}">
                        </div>
                        <div class="mb-3">
                            <label for="tahunterbit" class="form-label">Tahun Terbit</label>
                            <input type="number" min="1900" max="2099" step="1" value="2016" class="form-control" id="tahunterbit" name="tahunterbit" value="{{ $buku->tahunterbit }}">
                        </div>
                        <div class="mb-3">
                            <label for="jenisbuku" class="form-label">Jenis Buku</label>
                            <select class="form-control" name="jenisbuku" id="jenisbuku" value="{{ $buku->jenisbuku }}">
                                <option value="Pengayaan">Pengayaan</option>
                            </select> 
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" step="1" value="1" class="form-control" id="jumlah" name="jumlah" value="{{ $buku->jumlah }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
