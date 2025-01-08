<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Peminjaman;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Hitung jumlah total alat
        $jumlahAlat = Alat::count();

        // Hitung jumlah alat yang dipinjam (status 'Dipinjam')
        $jumlahAlatDipinjam = Peminjaman::where('status', 'Dipinjam')->count();

        // Hitung jumlah alat yang sudah kembali
        $jumlahAlatKembali = Peminjaman::where('status', 'Kembali')->count();

        // Hitung jumlah alat yang dalam kondisi rusak
        $jumlahAlatRusak = Alat::where('kondisi_awal', 'Rusak')->count();

        // Ambil data peminjaman yang terjadi hari ini
        $peminjamanHariIni = Peminjaman::with(['siswa', 'detailPeminjaman.alat'])
            ->whereDate('tanggal_pinjam', Carbon::today())
            ->get();

        return view('home', compact(
            'jumlahAlat', // Total alat
            'jumlahAlatDipinjam', // Alat dipinjam
            'jumlahAlatKembali', // Alat kembali
            'jumlahAlatRusak', // Alat rusak
            'peminjamanHariIni' // Peminjaman hari ini
        ));
    }
}