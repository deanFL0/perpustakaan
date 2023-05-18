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
                    <h3 class="card-title">Silahkan Diisi</h3>

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
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="judul" name="judul">
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Untuk Kelas</label>
                            <select class="form-control" id="kelas" name="kelas">
                                <option value="VII">VII</option>
                                <option value="VII/1">VII/1</option>
                                <option value="VII/2">VII/2</option>
                                <option value="VIII">VIII</option>
                                <option value="VIII/1">VIII/1</option>
                                <option value="VIII/2">VIII/2</option>
                                <option value="IX">IX</option>
                                <option value="IX/1">IX/1</option>
                                <option value="IX/2">IX/2</option>
                                <option value="Umum">Umum</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pengarang" class="form-label">Penulis</label>
                            <input type="text" class="form-control" id="pengarang" name="pengarang">
                        </div>
                        <div class="mb-3">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit">
                        </div>
                        <div class="mb-3">
                            <label for="tahunterbit" class="form-label">Tahun Terbit</label>
                            <input type="number" min="1900" max="2099" step="1" value="2000" class="form-control" id="tahunterbit" name="tahunterbit">
                        </div>
                        <div class="mb-3">
                            <label for="jenisbuku" class="form-label">Jenis Buku</label>
                            <select class="form-control" name="jenisbuku" id="jenisbuku">
                                <option value="Biografi">Biografi</option>
                                <option value="Buku Bos">Buku Bos</option>
                                <option value="Buku Paket">Buku Paket</option>
                                <option value="Cerita Anak">Cerita Anak</option>
                                <option value="Kamus">Kamus</option>
                                <option value="Komik">Komik</option>
                                <option value="Koran">Koran</option>
                                <option value="Majalah">Majalah</option>
                                <option value="Novel">Novel</option>
                                <option value="Peta">Peta</option>
                                <option value="Pengayaan">Pengayaan</option>
                                <option value="Refrensi">Refrensi</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Salinan Buku</label>
                            <input type="number" step="1" value="1" class="form-control" id="jumlah" name="jumlah">
                        </div>
                        <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi Buku</label>
                            <select class="form-control" id="kondisi" name="kondisi">
                                <option value="Bagus">Bagus</option>
                                <option value="Rusak">Rusak</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    SMP PGRI 7 BANDUNG
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
