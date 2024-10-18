@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Data Siswa</h1>
@stop

@section('content')
    <div></div>
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
            $('#siswaTable').DataTable(); // Inisialisasi DataTables untuk tabel dengan id "example"
        });
    </script>
@stop