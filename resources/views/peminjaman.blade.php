@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Data Peminjaman</h1>
        <button class="btn btn-primary">Tambahkan <i class="fas fa-plus-circle"></i></button>
    </div>
@stop

@section('content')
    <div class="card card-outline card-dark">
        <div class="card-body">
            <!-- Tabel DataTables -->
            <table id="peminjamanTable" class="table table-bordered table-striped table-responsive-xl">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Nama Alat</th>
                        <th>Kondisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <!-- Inisialisasi DataTables -->
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#peminjamanTable').DataTable(); // Inisialisasi DataTables untuk tabel dengan id "example"
        });
    </script>
@stop
