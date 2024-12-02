@extends('adminlte::page')

@section('title', 'Tambah Alat')

@section('content_header')
    <h1>Tambah Alat</h1>
@stop

@section('content')
    <div class="card card-outline card-dark">
        <div class="card-body">
            <form action="/simpanjenisalat" method="POST">
                @csrf

                <!-- Jenis Alat -->
                <div class="form-group">
                    <label for="jenis_alat">Jenis Alat</label>
                    <input type="text" class="form-control" id="jenis_alat" name="jenis_alat"
                        placeholder="Masukkan Jenis Alat" required>
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/admin/jenisalat" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
    </div>
@endsection
