@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-4">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-user-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Siswa</span>
                    <span class="info-box-number">60</span>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-truck"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Barang Di Pinjam</span>
                    <span class="info-box-number">80</span>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-boxes"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Barang Kembali</span>
                    <span class="info-box-number">60</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-dark">
        <div class="card-header">
            <h2 class="card-title">Data Peminjaman Terbaru</h2>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body">
            <!-- Tabel DataTables -->
            <table id="homeTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Nama Barang</th>
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
            $('#homeTable').DataTable(); // Inisialisasi DataTables untuk tabel dengan id "example"
        });
    </script>
@stop
