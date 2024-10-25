@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Data Laporan</h1>
@stop

@section('content')
    <div class="card card-outline card-dark collapsed-card">
        <div class="card-header">
            <h2 class="card-title "><b>Data Alat Di Pinjam</b></h2>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" fdprocessedid="zj8qsh"><i
                        class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Tabel DataTables -->
            <table id="pinjamTable" class="table table-bordered table-striped table-responsive-xl">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Nama Alat</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <div class="card card-outline card-dark collapsed-card">
        <div class="card-header">
            <h2 class="card-title "><b>Data Alat Sesudah Di Kembalikan</b></h2>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" fdprocessedid="zj8qsh"><i
                        class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Tabel DataTables -->
            <table id="kembaliTable" class="table table-bordered table-striped table-responsive-xl">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Nama Alat</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
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
            $('#pinjamTable').DataTable(); // Inisialisasi DataTables untuk tabel dengan id "example"
        });
        $(document).ready(function() {
            $('#kembaliTable').DataTable(); // Inisialisasi DataTables untuk tabel dengan id "example"
        });
    </script>
@stop
