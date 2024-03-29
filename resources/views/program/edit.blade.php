@extends('master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <h1>Ubah Data Program Kerja Perpustakaan</h1>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ubah Data Program</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('program') }}" class="btn btn-primary mb-4">Kembali</a>
                    <form action="{{ route('program.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $program->id }}">
                        <div class="mb-3">
                            <label for="jenis_program">Jenis Program</label>
                            <input type="text" name="jenis_program" placeholder="Nama program" class="form-control"
                                value="{{ $program->jenis_program }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kegiatan">Jenis Kegiatan</label>
                            <ol>
                                <div id="jenisKegiatan">
                                    @foreach ($program->jenisKegiatan as $item)
                                        <li>
                                            @if ($loop->first)
                                                <div class="input-group mb-3">
                                                    <input type="text" name="jenis_kegiatan[]" placeholder="Jenis Kegiatan"
                                                        class="form-control" value="{{ $item->nama_kegiatan }}" required>
                                                </div>
                                            @else
                                                <div class="input-group mb-3">
                                                    <input type="text" name="jenis_kegiatan[]" placeholder="Jenis Kegiatan"
                                                        class="form-control" value="{{ $item->nama_kegiatan }}" required>
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="removeInput(this)">-</button>
                                                    </div>
                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                </div>
                            </ol>
                        </div>
                        <div class="mb3">
                            <button type="button" class="btn btn-primary" onclick="addInput()">+ Jenis Kegiatan</button>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="waktu_kegiatan">Waktu kegiatan</label>
                                <input type="month" name="waktu_kegiatan" class="form-control"
                                    value="{{ $program->waktu_kegiatan }}" required onchange="minDate()">
                            </div>
                            <div class="col-6">
                                <label for="waktu_selesai">Waktu Selesai</label>
                                <input type="month" name="waktu_selesai" class="form-control"
                                    value="{{ $program->waktu_selesai }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="{{ $program->keterangan }}">
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
            const input = document.createElement("li");
            const div = document.createElement("div");
            div.className = "input-group mb-3";
            div.innerHTML = `<input type="text" name="jenis_kegiatan[]" placeholder="Jenis Kegiatan" class="form-control" required>`;

            const divButton = document.createElement("div");
            divButton.className = "input-group-append";
            divButton.innerHTML = `<button type="button" class="btn btn-danger" onclick="removeInput(this)">-</button>`;
            div.appendChild(divButton);

            input.appendChild(div);
            container.appendChild(input);
        }

        function removeInput(div) {
            //remove the li element
            document.getElementById("jenisKegiatan").removeChild(div.parentNode.parentNode.parentNode);
        }

        function minDate() {
            const waktuKegiatan = document.getElementsByName("waktu_kegiatan")[0].value;
            document.getElementsByName("waktu_selesai")[0].min = waktuKegiatan;
        }
    </script>
@endpush
