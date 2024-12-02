@extends('adminlte::page')

@section('title', 'Tambah Alat')

@section('content_header')
    <h1>Tambah Alat</h1>
@stop

@section('content')
    <div class="card card-outline card-dark">
        <div class="card-body">
            <form action="/simpanalat" method="POST">
                @csrf
                <!-- Nama Alat -->
                <div class="form-group">
                    <label for="nama_alat">Nama Alat</label>
                    <input type="text" class="form-control" id="nama_alat" name="nama_alat" placeholder="Masukkan Nama Alat"
                        required>
                </div>

                <!-- Jenis Alat -->
                <div class="form-group">
                    <label for="jenis_id">Jenis Alat</label>
                    <select class="form-control" id="jenis_id" name="jenis_id" required>
                        <option value="">-- Pilih Jenis Alat --</option>
                        @foreach($jenis as $a)
                            <option value="{{ $a->id }}">{{ $a->jenis_alat }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Kondisi -->
                <div class="form-group">
                    <label for="kondisi">Kondisi</label>
                    <select class="form-control" id="kondisi" name="kondisi" required>
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="Baik">Baik</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </div>

                <!-- Stok -->
                <div class="form-group">
                    <label for="stok">Stok Alat</label>
                    <input type="number" class="form-control" id="stok" name="stok"
                        placeholder="Masukkan Stok Alat" required>
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/admin/alat" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
    </div>
@endsection
