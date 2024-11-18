@extends('adminlte::page')

@section('title', 'Edit Siswa')

@section('content_header')
    <h1>Edit Siswa</h1>
@stop

@section('content')
    <div class="card card-outline card-dark">
        <div class="card-body">
            <form action="/siswa/{{ $siswa->id }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Siswa -->
                <div class="form-group">
                    <label for="nama_siswa">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa"
                        value="{{ $siswa->nama_siswa }}" placeholder="Nama Siswa" required>
                </div>

                <!-- kelas -->
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas"
                        value="{{ $siswa->kelas }}" placeholder="kelas" required>
                </div>

                <!-- No HP -->
                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                        value="{{ $siswa->no_hp }}" placeholder="No HP" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/admin/siswa" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@stop
