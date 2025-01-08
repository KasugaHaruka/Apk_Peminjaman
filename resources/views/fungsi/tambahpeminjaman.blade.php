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
                    <select class="form-control select2" id="siswa_id" name="siswa_id" required>
                        <option selected disabled>-- Pilih Siswa --</option>
                        @foreach ($siswa as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_siswa }}</option>
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control alat-select" name="alat_id[]" required>
                                        <option selected disabled>-- Pilih Alat --</option>
                                        @foreach ($alat as $a)
                                            <option value="{{ $a->id }}"
                                                @if ($a->kondisi_awal === 'Rusak') disabled style="color: gray;" @endif>
                                                {{ $a->nama_alat }} - {{ $a->jenis->jenis_alat }}
                                                ({{ $a->kondisi_awal }})
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah"
                                        min="1" required>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success addRow">Tambah</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <!-- Keterangan -->
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Masukkan Keterangan"></textarea>
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/admin/peminjaman" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 40px;
            /* Tinggi elemen */
            font-size: 17px;
            /* Ukuran teks yang sesuai dengan tinggi 30px */
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 40px;
            /* Pastikan teks sejajar secara vertikal */
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
            /* Panah juga disesuaikan */
        }
    </style>

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2, .alat-select').select2();

            // Tambah baris alat
            $('#dynamicAlatTable').on('click', '.addRow', function() {
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
                    </tr>`;
                $('#dynamicAlatTable tbody').append(newRow);
                $('.alat-select').select2();
            });

            // Hapus baris alat
            $('#dynamicAlatTable').on('click', '.removeRow', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
@stop
