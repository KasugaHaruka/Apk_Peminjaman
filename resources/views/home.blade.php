@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-3">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-tools"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Alat</span>
                    <span class="info-box-number">{{ $jumlahAlat }}</span>
                </div>
            </div>            
        </div>
        <div class="col-3">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-truck"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Alat Di Pinjam</span>
                    <span class="info-box-number">{{ $jumlahAlatDipinjam }}</span>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-boxes"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Alat Sudah Kembali</span>
                    <span class="info-box-number">{{ $jumlahAlatKembali }}</span>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-house-damage"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Alat Kondisi Rusak</span>
                    <span class="info-box-number">{{ $jumlahAlatRusak }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-dark">
        <div class="card-header">
            <h2 class="card-title "><b>Peminjaman Hari Ini</b></h2>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" fdprocessedid="69z2w9">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if ($peminjamanHariIni->isEmpty())
                <div class="alert alert-info text-center">
                    <strong>Tidak ada data peminjaman hari ini.</strong>
                </div>
            @else
                <!-- Tabel DataTables -->
                <table id="peminjamanHariIniTable" class="table table-bordered table-responsive-xl table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Alat</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjamanHariIni as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->siswa->nama_siswa }}</td>
                                <td>{{ $p->tanggal_pinjam }}</td>
                                <td>{{ $p->tanggal_kembali ?? '-' }}</td>
                                <td>{{ $p->status }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $p->id }}">
                                        Detail
                                    </button>
                                </td>
                                <td>{{ $p->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Modal Detail -->
    @foreach ($peminjamanHariIni as $p)
        <div class="modal fade" id="detailModal{{ $p->id }}" tabindex="-1"
            aria-labelledby="detailModalLabel{{ $p->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel{{ $p->id }}">Detail Alat yang Dipinjam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered" id="detailTable">
                            <thead>
                                <tr>
                                    <th>Nama Alat</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($p->detailPeminjaman as $detail)
                                    <tr>
                                        <td>{{ $detail->alat->nama_alat }}</td>
                                        <td>{{ $detail->jumlah }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#peminjamanHariIniTable').DataTable(); // Inisialisasi DataTables untuk tabel dengan id "peminjamanHariIniTable"
        });
    </script>
@stop