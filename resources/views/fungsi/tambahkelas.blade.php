@extends('adminlte::page')

@section('title', 'Tambah Alat')

@section('content_header')
    <h1>Tambah Kelas</h1>
@stop

@section('content')
    <div class="card card-outline card-dark">
        <div class="card-body">
            <form action="/simpankelas" method="POST">
                @csrf

                <!-- Jenis Alat -->
                <div class="form-group">
                    <label for="nama_kelas">Jenis Alat</label>
                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas"
                        placeholder="Masukkan Kelas" required>
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/admin/kelas" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
    </div>
@endsection
