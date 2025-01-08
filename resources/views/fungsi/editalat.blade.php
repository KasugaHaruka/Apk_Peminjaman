@extends('adminlte::page')

@section('title', 'Edit Alat')

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

                <div class="mb-3">
                    <label for="jenis_id" class="form-label">Jenis Alat</label>
                    <select class="form-control" id="jenis_id" name="jenis_id">
                        <option value="">Pilih Jenis Alat</option>
                        @foreach($jenis as $a)
                            <option value="{{ $a->id }}"{{ $alat->jenis_id == $a->id ? 'selected' : '' }}>{{ $a->jenis_alat }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Kondisi -->
                <div class="form-group">
                    <label for="kondisi_awal">Kondisi</label>
                    <select class="form-control" id="kondisi_awal" name="kondisi_awal" required>
                        <option value="Baik" {{ $alat->kondisi_awal == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak" {{ $alat->kondisi_awal == 'Rusak' ? 'selected' : '' }}>Rusak</option>
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
