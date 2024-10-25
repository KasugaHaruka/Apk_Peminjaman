@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Data Alat</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-alat">Tambahkan <i class="fas fa-plus-circle"></i></button>
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
                        <th>Kondisi</th>
                        <th>Stok Alat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="/editbarang/" type="button"
                                class="btn btn-warning">
                                Ubah
                            </a>
                            <form action="/hapus/" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Kamu Yakin?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modal-alat" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Alat</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form-siswa">
                        <div class="form-group row">
                            <label for="inputNama" class="col-sm-2 col-form-label">Nama Alat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_alat" name="nama_alat"
                                    placeholder="Masukkan Nama Alat">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputKondisi" class="col-sm-2 col-form-label">Kondisi</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="kondisi" name="kondisi">
                                    <option value="">-- Pilih Kondisi --</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <label for="inputNoHP" class="col-sm-2 col-form-label">Stok Alat</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="stok" name="stok"
                                    placeholder="Masukkan Stok Alat">
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
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
