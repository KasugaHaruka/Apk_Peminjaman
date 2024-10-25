@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Data Peminjaman</h1>
        <a href="/tambahpeminjaman" class="btn btn-primary">Tambahkan <i class="fas fa-plus-circle"></i></a>
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
                        <th>Status</th>
                        <th>Nama Alat</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <td>1</td>
                    <td>Alfian Syahrul R</td>
                    <td>05-10-2024</td>
                    <td>10-10-2024</td>
                    <td>Dipinjam</td>
                    <td>Obeng</td>
                    <td>1</td>
                    <td>Baik</td>
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

    <div class="modal fade" id="modal-peminjaman" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Peminjaman</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form-peminjaman">
                        <!-- Nama Siswa -->
                        <div class="form-group row">
                            <label for="nama_siswa" class="col-sm-3 col-form-label">Nama Siswa</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa"
                                    placeholder="Masukkan Nama Siswa">
                            </div>
                        </div>
                        <!-- Tanggal Pinjam -->
                        <div class="form-group row">
                            <label for="tanggal_pinjam" class="col-sm-3 col-form-label">Tanggal Pinjam</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam">
                            </div>
                        </div>
                        <!-- Tanggal Kembali -->
                        <div class="form-group row">
                            <label for="tanggal_kembali" class="col-sm-3 col-form-label">Tanggal Kembali</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali">
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="form-group row">
                            <label for="status" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="status" name="status">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Sedang Dipinjam">Sedang Dipinjam</option>
                                    <option value="Dikembalikan">Dikembalikan</option>
                                </select>
                            </div>
                        </div>
                        <!-- Nama Alat -->
                        <div class="form-group row">
                            <label for="nama_alat" class="col-sm-3 col-form-label">Nama Alat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_alat" name="nama_alat"
                                    placeholder="Masukkan Nama Alat">
                            </div>
                        </div>
                        <!-- Kondisi -->
                        <div class="form-group row">
                            <label for="kondisi" class="col-sm-3 col-form-label">Kondisi</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="kondisi" name="kondisi">
                                    <option value="">-- Pilih Kondisi --</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#peminjamanTable').DataTable(); // Inisialisasi DataTables untuk tabel dengan id "example"
        });
    </script>
@stop
