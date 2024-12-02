@extends('adminlte::page')

@section('title', 'Tambah Peminjaman')

@section('content_header')
    <h1>Tambah Peminjaman</h1>
@stop

@section('content')
    <div class="card card-outline card-dark">
        <div class="card-body">
            <form action="/simpanpeminjaman" method="POST">
                @csrf

                <!-- Nama Siswa -->
                <div class="form-group">
                    <label for="siswa_id">Nama Siswa</label>
                    <select class="form-control" id="siswa_id" name="siswa_id" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($siswa as $s)
                            <option value="{{ $s->siswa_id }}">{{ $s->nama_siswa }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Pinjam -->
                <div class="form-group">
                    <label for="tanggal_pinjam">Tanggal Pinjam</label>
                    <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" required>
                </div>

                <!-- Dynamic Input untuk Alat -->
                <div class="form-group">
                    <label>Alat yang Dipinjam</label>
                    <table class="table table-bordered" id="dynamicAlatTable">
                        <thead>
                            <tr>
                                <th>Nama dan Jenis Alat</th>
                                <th>Jumlah</th>
                                <th>Kondisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control" name="alat_id[]" required>
                                        <option value="">-- Pilih Alat --</option>
                                        @foreach ($alat as $a)
                                            <option value="{{ $a->alat_id }}">{{ $a->nama_alat }} - {{ $a->jenis->jenis_alat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="jumlah[]" placeholder="Masukkan Jumlah"
                                        required>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success" id="addRow">Tambah</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Keterangan -->
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="keterangan" rows="5" placeholder="Masukkan Keterangan"></textarea>
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/admin/peminjaman" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    let alatTable = document.querySelector('#dynamicAlatTable tbody');
    let addRowBtn = document.querySelector('#addRow');

    addRowBtn.addEventListener('click', function () {
    let newRow = `
    <tr>
        <td>
            <select class="form-control" name="alat_id[]" required>
                <option value="">-- Pilih Alat --</option>
                @foreach ($alat as $a)
                    <option value="{{ $a->alat_id }}">{{ $a->nama_alat }} - {{ $a->jenis->jenis_alat }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="number" class="form-control" name="jumlah[]" placeholder="Masukkan Jumlah" required>
        </td>
        <td>
            <select class="form-control" name="kondisi[]" required>
                <option value="">-- Pilih Kondisi --</option>
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
            </select>
        </td>
        <td>
            <button type="button" class="btn btn-danger removeRow">Hapus</button>
        </td>
    </tr>
    `;
    alatTable.insertAdjacentHTML('beforeend', newRow);
    });

    // Event Listener untuk Hapus Baris
    alatTable.addEventListener('click', function (e) {
    if (e.target.classList.contains('removeRow')) {
    e.target.closest('tr').remove();
    }
    });
    });
</script>
@stop
