@extends('adminlte::page')

@section('title', 'Laporan Pengembalian')

@section('content_header')
    <h1>Data Laporan</h1>
@stop

@section('content')
    <div class="card card-outline card-dark">
        <div class="card-header">
            <b><h3 class="card-title">Data Alat Kembali</h3></b>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if ($laporanPengembalian->isEmpty())
                <div class="alert alert-info text-center">
                    <strong>Tidak ada data pengembalian.</strong>
                </div>
            @else
                <!-- Tabel DataTables -->
                <table id="laporTable" class="table table-bordered table-responsive-xl table-hover">
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
                        @foreach ($laporanPengembalian as $kembali)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kembali->peminjaman->siswa->nama_siswa }}</td>
                                <td>{{ $kembali->peminjaman->tanggal_pinjam }}</td>
                                <td>{{ $kembali->peminjaman->tanggal_kembali }}</td>
                                <td>{{ $kembali->peminjaman->status }}</td>
                                <td>
                                    <!-- Tombol Detail Modal -->
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $kembali->id }}">
                                        Detail
                                    </button>
                                </td>
                                <td>{{ $kembali->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="card card-outline card-dark">
        <div class="card-header">
            <b><h3 class="card-title">Data Alat Rusak Setelah Kembali</h3></b>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if ($laporanDetailKembali->isEmpty())
                <div class="alert alert-info text-center">
                    <strong>Tidak ada data alat yang rusak.</strong>
                </div>
            @else
                <table id="alatRusakTable" class="table table-bordered table-responsive-xl table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Alat</th>
                            <th>Jenis Alat</th>
                            <th>Jumlah Rusak</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporanDetailKembali as $rusak)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $rusak->alat->nama_alat }}</td>
                                <td>{{ $rusak->alat->jenis->jenis_alat }}</td>
                                <td>{{ $rusak->jumlah }}</td>
                                <td>{{ $rusak->kondisi_akhir }}</td>
                                <td>
                                    @if ($rusak->kondisi_akhir === 'Rusak')
                                    <form action="/alat/sudah-diperbaiki/{{ $rusak->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">
                                            Sudah Diperbaiki
                                        </button>
                                    </form>
                                @else
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $kembali->id }}">
                                    Detail
                                </button>                                
                                @endif                                
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Modal Detail -->
    @foreach ($laporanPengembalian as $kembali)
    <div class="modal fade" id="detailModal{{ $kembali->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $kembali->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel{{ $kembali->id }}">Detail Alat yang Dikembalikan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Alat</th>
                                <th>Jumlah</th>
                                <th>Kondisi Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kembali->detailK as $detail)
                                <tr>
                                    <td>{{ $detail->alat->nama_alat ?? 'Tidak Ada Data' }}</td>
                                    <td>{{ $detail->jumlah ?? 'Tidak Ada Data' }}</td>
                                    <td>{{ $detail->kondisi_akhir ?? 'Tidak Ada Data' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak Ada Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endforeach
@stop

@section('css')
    {{-- Tambahkan style tambahan jika diperlukan --}}
    <link rel="stylesheet" href="{{ asset('vendor/datatables/datatables.min.css') }}">
@stop

@section('js')
    <!-- Inisialisasi DataTables -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#laporTable').DataTable(); // Inisialisasi DataTables
        });
        $(document).ready(function() {
        $('.modal').on('shown.bs.modal', function() {
            console.log('Modal terbuka');
        });
        });
    </script>
@stop
