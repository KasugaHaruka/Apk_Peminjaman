<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Siswa;
use App\Models\Alat;

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
        return view('fungsi.tambahpeminjaman', ['siswa' => $siswa, 'alat' => $alat]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        // // Validasi Input
        // $request->validate([
        //     'siswa_id' => 'required',
        //     'tanggal_pinjam' => 'required|date',
        //     'alat_id.*' => 'required',
        //     'jumlah.*' => 'required|integer|min:1',
        //     'kondisi.*' => 'required',
        // ]);

        // // Simpan Data Peminjaman
        // $peminjaman = Peminjaman::create([
        //     'siswa_id' => $request->siswa_id,
        //     'tanggal_pinjam' => $request->tanggal_pinjam,
        //     'keterangan' => $request->keterangan,
        // ]);

        // // Simpan Detail Peminjaman dan Kurangi Stok Alat
        // foreach ($request->alat_id as $index => $alat_id) {
        //     $alat = Alat::find($alat_id);

        //     // Pastikan stok alat cukup untuk dipinjam
        //     if ($alat->stok < $request->jumlah[$index]) {
        //         return redirect()->back()->with('error', 'Stok alat tidak cukup.');
        //     }

        //     // Kurangi stok alat
        //     $alat->stok -= $request->jumlah[$index];
        //     $alat->save();

        //     // Simpan Detail Peminjaman
        //     DetailPeminjaman::create([
        //         'peminjaman_id' => $peminjaman->id,
        //         'alat_id' => $alat_id,
        //         'jumlah' => $request->jumlah[$index],
        //         'kondisi' => $request->kondisi[$index],
        //     ]);
        // }
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
        $peminjaman = Peminjaman::findOrFail($id);
        $siswa = Siswa::all();
        $alat = Alat::all();
        return view('fungsi.editpeminjaman', compact('peminjaman', 'siswa', 'alat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Update peminjaman
        $peminjaman->update($request->except(['_token', 'submit']));

        return redirect('/admin/peminjaman');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->delete();

        return redirect('/admin/peminjaman');
    }
}