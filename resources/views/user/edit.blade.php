@extends('master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <h1>Edit User</h1>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ubah Data User</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('user') }}" class="btn btn-primary mb-4">Kembali</a>
                    <form action="{{ route('user.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" placeholder="Nama" class="form-control" value="{{ $user->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="role">User Role</label>
                            <select name="role" class="form-control" required>
                                <option value="Petugas" {{ $user->status == 'Petugas' ? 'selected' : '' }}>Petugas</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" placeholder="Username" class="form-control" value="{{ $user->username }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="text" name="password" placeholder="Password" class="form-control" value="{{ $user->password }}" required>
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
