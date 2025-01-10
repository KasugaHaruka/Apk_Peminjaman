<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Siswa;
use App\Models\Alat;
use App\Models\KembaliPeminjaman;
use App\Models\DetailKembali;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = Peminjaman::all();
        return view('peminjaman', ['peminjaman' => $peminjaman]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswa = Siswa::all();
        $alat = Alat::all();
        return view('fungsi.tambahpeminjaman', compact('siswa', 'alat'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'tanggal_pinjam' => 'required|date',
            'alat_id.*' => 'required|exists:alat,id', // Validasi setiap elemen array
            'jumlah.*' => 'required|integer|min:1',
        ]);

        // Simpan data peminjaman
        $peminjaman = Peminjaman::create([
            'siswa_id' => $request->siswa_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'keterangan' => $request->keterangan,
        ]);

        // Simpan detail peminjaman dan kurangi stok alat
        foreach ($request->alat_id as $index => $alat_id) {
            $alat = Alat::findOrFail($alat_id);

            // Cek stok alat
            if ($alat->stok < $request->jumlah[$index]) {
                return redirect()->back()->with('error', 'Stok alat tidak cukup untuk dipinjam.');
            }

            // Kurangi stok alat
            $alat->stok -= $request->jumlah[$index];
            $alat->save();

            // Simpan detail peminjaman
            DetailPeminjaman::create([
                'peminjaman_id' => $peminjaman->id,
                'alat_id' => $alat_id,
                'jumlah' => $request->jumlah[$index],
            ]);
        }

        return redirect('/admin/peminjaman')->with('success', 'Peminjaman berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $peminjaman = Peminjaman::with('detailPeminjaman.alat')->findOrFail($id);
        $siswa = Siswa::all();
        $alat = Alat::all();
        return view('fungsi.editpeminjaman', compact('peminjaman', 'siswa', 'alat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'tanggal_pinjam' => 'required|date',
            'keterangan' => 'nullable|string',
            'alat_id' => 'required|array',
            'alat_id.*' => 'exists:alat,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'integer|min:1',
        ]);

        // Cari data peminjaman berdasarkan ID
        $peminjaman = Peminjaman::with('detailPeminjaman')->findOrFail($id);

        // Kembalikan stok alat dari detail lama
        foreach ($peminjaman->detailPeminjaman as $detail) {
            $alat = Alat::find($detail->alat_id);
            if ($alat) {
                $alat->update(['stok' => $alat->stok + $detail->jumlah]);
            }
        }

        // Update data di tabel `peminjaman`
        $peminjaman->update([
            'siswa_id' => $request->siswa_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'keterangan' => $request->keterangan,
        ]);

        // Sinkronisasi data detail peminjaman
        $details = [];
        foreach ($request->alat_id as $index => $alatId) {
            $jumlah = $request->jumlah[$index];

            // Update stok alat
            $alat = Alat::find($alatId);
            if ($alat) {
                if ($alat->stok < $jumlah) {
                    return back()->withErrors(['msg' => "Stok alat '{$alat->nama_alat}' tidak mencukupi!"]);
                }
                $alat->update(['stok' => $alat->stok - $jumlah]);
            }

            $details[] = [
                'alat_id' => $alatId,
                'jumlah' => $jumlah,
            ];
        }

        // Hapus detail lama dan simpan detail baru
        $peminjaman->detailPeminjaman()->delete();
        $peminjaman->detailPeminjaman()->createMany($details);

        // Redirect ke halaman daftar peminjaman
        return redirect('/admin/peminjaman')->with('success', 'Data peminjaman berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mendapatkan data peminjaman yang ingin dihapus
        $peminjaman = Peminjaman::with('detailPeminjaman')->findOrFail($id);

        // Jika peminjaman sudah dikembalikan, jangan mengubah stok
        if ($peminjaman->status != 'Kembali') {
            // Jika peminjaman belum dikembalikan, kembalikan stok alat
            foreach ($peminjaman->detailPeminjaman as $detail) {
                $alat = Alat::find($detail->alat_id);
                if ($alat) {
                    $alat->stok += $detail->jumlah; // Menambah stok alat yang dipinjam
                    $alat->save();
                }
            }
        }

        // Hapus peminjaman
        $peminjaman->delete();

        // Redirect dengan pesan sukses
        return redirect('/admin/peminjaman')->with('success', 'Peminjaman berhasil dihapus.');
    }

    public function kembali(Request $request, string $id)
    {
        // Mendapatkan peminjaman dan detailnya
        $peminjaman = Peminjaman::with('detailPeminjaman')->findOrFail($id);

        // Update status dan tanggal kembali
        $peminjaman->status = 'Kembali';
        $peminjaman->tanggal_kembali = now(); // Set tanggal kembali ke tanggal hari ini
        $peminjaman->save();

        // Buat satu entri di tabel `kembali_peminjaman`
        $kembaliPeminjaman = KembaliPeminjaman::create([
            'peminjaman_id' => $peminjaman->id,
            'keterangan' => $request->keterangan_kembali, // Keterangan pengembalian
        ]);

        // Iterasi setiap detail peminjaman untuk mengembalikan alat
        foreach ($peminjaman->detailPeminjaman as $detail) {
            // Temukan alat yang dipinjam
            $alat = Alat::find($detail->alat_id);

            // Ambil kondisi akhir dari request
            $kondisi_akhir = $request->kondisi_akhir[$detail->alat_id] ?? 'Baik'; // Default kondisi "Baik"

            if ($alat) {
                // Menambah stok alat yang dikembalikan
                $alat->stok += $detail->jumlah;
                $alat->save();
            }

            // Simpan data detail ke `detail_kembali_peminjaman`
            DetailKembali::create([
                'kembali_peminjaman_id' => $kembaliPeminjaman->id,
                'alat_id' => $detail->alat_id,
                'jumlah' => $detail->jumlah,
                'kondisi_akhir' => $kondisi_akhir,
            ]);
        }

        // Redirect ke halaman peminjaman dengan pesan sukses
        return redirect('/admin/peminjaman')->with('success', 'Peminjaman berhasil dikembalikan.');
    }
}
