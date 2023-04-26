@extends('master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <h1>Input Program Perpustakaan</h1>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Program</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('program') }}" class="btn btn-primary mb-4">Kembali</a>
                    <form action="{{ route('program.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="jenis_program">Jenis Program</label>
                            <input type="text" name="jenis_program" placeholder="Jenis Program" class="form-control"
                                required>
                        </div>
                        <div id="jenisKegiatan" class="mb-3">
                            <label for="jenis_kegiatan">Jenis Kegiatan</label>
                            {{-- <textarea name="jenis_kegiatan" class="form-control" cols="30" rows="10" required></textarea> --}}
                            <input type="text" name="jenis_kegiatan" placeholder="Jenis Kegiatan" class="form-control"
                                required>
                        </div>
                        <div class="mb3">
                            <button type="button" class="btn btn-primary" onclick="addInput()">+ Jenis Kegiatan</button>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="waktu_kegiatan">Waktu kegiatan</label>
                                <input type="month" name="waktu_kegiatan" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label for="waktu_selesai">Waktu Selesai</label>
                                <input type="month" name="waktu_selesai" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
                <!-- /.card-footer-->
            </div>
        </section>
    </div>
@endsection

@push('js')
    <script>
        const container = document.getElementById("jenisKegiatan");

        // Call addInput() function on button click
        function addInput() {
            //add input text
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'jenis_kegiatan[]';
            input.placeholder = 'Jenis Kegiatan';
            input.className = 'form-control';
            input.required = true;
            container.appendChild(input);
        }
    </script>
@endpush
