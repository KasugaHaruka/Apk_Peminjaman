@extends('adminlte::page')

@section('title', 'Tambah Alat')

@section('content_header')
    <h1>Edit Kelas</h1>
@stop

@section('content')
    <div class="card card-outline card-dark">
        <div class="card-body">
            <form action="/kelas/{{ $kelas->id }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Stok -->
                <div class="form-group">
                    <label for="nama_kelas">Kelas</label>
                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas"
                        placeholder="Masukkan Kelas" value="{{ $kelas->nama_kelas }}" required>
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/admin/kelas" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
    </div>
@endsection