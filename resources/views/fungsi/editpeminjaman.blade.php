@extends('adminlte::page')

@section('title', 'Edit Peminjaman')

@section('content_header')
    <h1>Edit Peminjaman</h1>
@stop

@section('content')
<div class="card card-outline card-dark">
    <div class="card-body">
        <form action="/peminjaman/{{ $peminjaman->id }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Siswa -->
            <div class="form-group">
                <label for="siswa_id">Nama Siswa</label>
                <select class="form-control" id="siswa_id" name="siswa_id" required>
                    <option value="" disabled>Pilih Siswa</option>
                    @foreach($siswa as $s)
                        <option value="{{ $s->id }}" {{ $peminjaman->siswa_id == $s->id ? 'selected' : '' }}>
                            {{ $s->nama_siswa }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal Pinjam -->
            <div class="form-group">
                <label for="tanggal_pinjam">Tanggal Pinjam</label>
                <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ $peminjaman->tanggal_pinjam }}" required>
            </div>

            <!-- Keterangan -->
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ $peminjaman->keterangan }}</textarea>
            </div>

            <!-- Detail Peminjaman -->
            <div class="form-group">
                <label>Alat yang Dipinjam</label>
                <table class="table table-bordered" id="dynamicAlatTable">
                    <thead>
                        <tr>
                            <th>Nama dan Jenis Alat</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman->detailPeminjaman as $index => $detail)
                        <tr>
                            <td>
                                <select class="form-control alat-select" name="alat_id[]" required>
                                    <option selected disabled>-- Pilih Alat --</option>
                                    @foreach ($alat as $a)
                                        <option value="{{ $a->id }}" {{ $detail->alat_id == $a->id ? 'selected' : '' }}>
                                            {{ $a->nama_alat }} - {{ $a->jenis->jenis_alat }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah"
                                    value="{{ $detail->jumlah }}" min="1" required>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger removeRow">Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="button" class="btn btn-success mt-3" id="addAlatRow">Tambah Alat</button>
            </div>            

            <!-- Tombol -->
            <button type="submit" class="btn btn-primary mt-3">Update</button>
            <a href="/admin/peminjaman" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    // Fungsi Tambah Baris Alat
    document.getElementById('addAlatRow').addEventListener('click', function () {
        const tableBody = document.querySelector('#dynamicAlatTable tbody');
        const newRow = `
            <tr>
                <td>
                    <select class="form-control alat-select" name="alat_id[]" required>
                        <option selected disabled>-- Pilih Alat --</option>
                        @foreach ($alat as $a)
                            <option value="{{ $a->id }}">{{ $a->nama_alat }} - {{ $a->jenis->jenis_alat }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah" min="1" required>
                </td>
                <td>
                    <button type="button" class="btn btn-danger removeRow">Hapus</button>
                </td>
            </tr>
        `;
        tableBody.insertAdjacentHTML('beforeend', newRow);
    });

    // Fungsi Hapus Baris Alat
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('removeRow')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endsection