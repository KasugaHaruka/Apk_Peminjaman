@extends('adminlte::page')

@section('title', 'Tambah Siswa')

@section('content_header')
    <h1>Tambah Siswa</h1>
@stop

@section('content')
    <div class="card card-outline card-dark">
        <div class="card-body">
            <form action="/simpansiswa" method="POST">
                @csrf
                <!-- Nama Siswa -->
                <div class="form-group">
                    <label for="nama_siswa">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Nama Siswa" required>
                </div>

                <!-- Kelas -->
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Kelas" required>
                </div>

                <!-- No HP -->
                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No HP">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/admin/siswa" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@stop