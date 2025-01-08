<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KembaliPeminjaman;
use App\Models\DetailKembali;
use App\Models\Alat;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporanPengembalian = KembaliPeminjaman::all();
        $laporanDetailKembali = DetailKembali::with('alat.jenis')
        ->where('kondisi_akhir', 'Rusak')
        ->get();

        return view('laporan', compact('laporanPengembalian','laporanDetailKembali'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function sudahDiperbaiki($id)
    {
        // Temukan alat berdasarkan ID
        $alat = Alat::findOrFail($id);

        // Update kondisi menjadi "Baik"
        $alat->kondisi_awal = 'Baik';
        $alat->save();

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Status alat berhasil diperbarui menjadi Baik.');
    }
    public function updateStatus($id)
    {
        $detail = DetailKembali::findOrFail($id);
    
        if ($detail->kondisi_akhir === 'Rusak') {
            $detail->kondisi_akhir = 'Baik';
            $detail->save();
    
            return redirect()->back()->with('success', 'Status alat berhasil diperbarui.');
        }
    
        return redirect()->back()->with('error', 'Status alat tidak dapat diubah.');
    }
    
}
