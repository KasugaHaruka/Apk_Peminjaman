@extends('adminlte::page')

@section('title', 'Edit Peminjaman')

@section('content_header')
    <h1>Edit Peminjaman</h1>
@stop

@section('content')
<div class="card card-outline card-dark">
        <div class="card-body">
            <form action="/peminjaman/{{ $peminjaman->id }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Siswa -->
                <div class="form-group">
                    <label for="nama_siswa">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="{{ $peminjaman->nama_siswa }}" required>
                </div>

                <!-- Tanggal Pinjam -->
                <div class="form-group">
                    <label for="tanggal_pinjam">Tanggal Pinjam</label>
                    <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ $peminjaman->tanggal_pinjam }}" required>
                </div>

                <!-- Tanggal Kembali -->
                <div class="form-group">
                    <label for="tanggal_kembali">Tanggal Kembali</label>
                    <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" value="{{ $peminjaman->tanggal_kembali }}">
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Sedang Dipinjam" {{ $peminjaman->status == 'Sedang Dipinjam' ? 'selected' : '' }}>Sedang Dipinjam</option>
                        <option value="Dikembalikan" {{ $peminjaman->status == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    </select>
                </div>

                <!-- Nama Alat -->
                <div class="form-group">
                    <label for="nama_alat">Nama Alat</label>
                    <input type="text" class="form-control" id="nama_alat" name="nama_alat" value="{{ $peminjaman->nama_alat }}" required>
                </div>

                <!-- Kondisi -->
                <div class="form-group">
                    <label for="kondisi">Kondisi</label>
                    <select class="form-control" id="kondisi" name="kondisi" required>
                        <option value="Baik" {{ $peminjaman->kondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak" {{ $peminjaman->kondisi == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                    </select>
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/admin/peminjaman" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
