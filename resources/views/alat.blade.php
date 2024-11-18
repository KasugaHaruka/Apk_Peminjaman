@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Data Alat</h1>
        <a class="btn btn-primary" href="/tambahalat">Tambahkan <i class="fas fa-plus-circle"></i></a>
    </div>
@stop

@section('content')
    <div class="card card-outline card-dark">
        <div class="card-body">
            <!-- Tabel DataTables -->
            <table id="alatTable" class="table table-bordered table-hover table-responsive-xl">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Alat</th>
                        <th>Jenis Alat</th>
                        <th>Kondisi</th>
                        <th>Stok Alat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alat as $a)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $a->nama_alat }}</td>
                            <td>{{ $a->jenis_alat }}</td>
                            <td>{{ $a->kondisi }}</td>
                            <td>{{ $a->stok }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/editalat/{{ $a->id }}" type="button" class="btn btn-warning">
                                        Ubah
                                    </a>
                                    <form action="/hapusalat/{{ $a->id }}" method="POST" class="ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Kamu Yakin?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
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
            $('#alatTable').DataTable(); // Inisialisasi DataTables untuk tabel dengan id "example"
        });
    </script>
@stop
