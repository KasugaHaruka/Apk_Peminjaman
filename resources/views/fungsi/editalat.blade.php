@extends('adminlte::page')

@section('title', 'Tambah Siswa')

@section('content_header')
    <h1>Edit Alat</h1>
@stop

@section('content')
    <div class="card card-outline card-dark">
        <div class="card-body">
            <form action="/alat/{{ $alat->id }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Alat -->
                <div class="form-group">
                    <label for="nama_alat">Nama Alat</label>
                    <input type="text" class="form-control" id="nama_alat" name="nama_alat" value="{{ $alat->nama_alat }}"
                        required>
                </div>

                <!-- Kondisi -->
                <div class="form-group">
                    <label for="kondisi">Kondisi</label>
                    <select class="form-control" id="kondisi" name="kondisi" required>
                        <option value="Baik" {{ $alat->kondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak" {{ $alat->kondisi == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                    </select>
                </div>

                <!-- Stok -->
                <div class="form-group">
                    <label for="stok">Stok Alat</label>
                    <input type="number" class="form-control" id="stok" name="stok" value="{{ $alat->stok }}"
                        required>
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/admin/alat" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
    </div>
@endsection
