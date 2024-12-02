@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Data Jenis Alat</h1>
        <a class="btn btn-primary" href="/tambahjenisalat">Tambahkan <i class="fas fa-plus-circle"></i></a>
    </div>
@stop

@section('content')
    <div class="card card-outline card-dark">
        <div class="card-body">
            <!-- Tabel DataTables -->
            <table id="jenisTable" class="table table-bordered table-hover table-responsive-xl">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Alat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jenis as $a)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $a->jenis_alat }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/editjenisalat/{{ $a->id }}" type="button" class="btn btn-warning">
                                        Ubah
                                    </a>
                                    <form action="/hapusjenisalat/{{ $a->id }}" method="POST" class="ml-2">
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
            $('#jenisTable').DataTable(); // Inisialisasi DataTables untuk tabel dengan id "example"
        });
    </script>
@stop
