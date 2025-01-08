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
            @if ($peminjaman->isEmpty())
                <div class="alert alert-info text-center">
                    <strong>Tidak ada data peminjaman.</strong>
                </div>
            @else
                <!-- Tabel DataTables -->
                <table id="peminjamanTable" class="table table-bordered table-responsive-xl table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Alat</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->siswa->nama_siswa }}</td>
                                <td>{{ $p->tanggal_pinjam }}</td>
                                <td>{{ $p->tanggal_kembali }}</td>
                                <td>{{ $p->status }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $p->id }}">
                                        Detail
                                    </button>
                                </td>
                                <td>{{ $p->keterangan }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="/editpeminjaman/{{ $p->id }}" type="button"
                                            class="btn btn-warning">
                                            Ubah
                                        </a>
                                        @if ($p->status === 'Dipinjam')
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#kembaliModal{{ $p->id }}">
                                                Kembali
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-secondary" disabled>
                                                Dikembalikan
                                            </button>
                                        @endif
                                        <form action="/hapuspeminjaman/{{ $p->id }}" method="POST" class="ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Apakah Kamu Yakin?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Modal Kembali -->
    @foreach ($peminjaman as $p)
        <div class="modal fade" id="kembaliModal{{ $p->id }}" tabindex="-1"
            aria-labelledby="kembaliModalLabel{{ $p->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="kembaliModalLabel{{ $p->id }}">Pengembalian Peminjaman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/kembalipeminjaman/{{ $p->id }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Alat</th>
                                            <th>Jumlah</th>
                                            <th>Kondisi Akhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($p->detailPeminjaman as $detail)
                                            <tr>
                                                <td>{{ $detail->alat->nama_alat }}</td>
                                                <td>{{ $detail->jumlah }}</td>
                                                <td>
                                                    <select name="kondisi_akhir[{{ $detail->alat->id }}]"
                                                        class="form-control" required>
                                                        <option value="Baik">Baik</option>
                                                        <option value="Rusak">Rusak</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group mt-3">
                                <label for="keterangan_kembali">Keterangan</label>
                                <textarea class="form-control" id="keterangan_kembali" name="keterangan_kembali" rows="3"
                                    placeholder="Tambahkan keterangan jika diperlukan"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Detail -->
    @foreach ($peminjaman as $p)
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
            $('#peminjamanTable').DataTable(); // Inisialisasi DataTables untuk tabel dengan id "example"
        });
        $(document).ready(function() {
            $('#detailTable').DataTable(); // Inisialisasi DataTables untuk tabel dengan id "example"
        });
    </script>
@stop
