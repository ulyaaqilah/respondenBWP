<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        // Kalau belum login, redirect ke /login
        if (!session('admin_logged_in')) {
            redirect()->route('login')->send();
        }
    }

    public function index()
    {
        // ambil semua ulasan
        $ulasan = Ulasan::latest()->get();

        // hitung rata-rata rating per bulan
        $ratingBulanan = Ulasan::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('YEAR(created_at) as tahun'),
            DB::raw('AVG(rating) as rata_rating')
        )
        ->groupBy('tahun','bulan')
        ->orderBy('tahun','desc')
        ->orderBy('bulan','desc')
        ->get();

        return view('admin.dashboard', compact('ulasan','ratingBulanan'));
    }

    public function reply(Request $request, $id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->balasan = $request->balasan;
        $ulasan->save();

        return redirect()->back()->with('success','Balasan berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();

        return redirect()->back()->with('success','Ulasan berhasil dihapus!');
    }

    public function reviews()
    {
        $ulasans = Ulasan::latest()->get();
        return view('admin.reviews', compact('ulasans'));
    }

    public function reports()
    {
        // contoh dummy data untuk laporan
        $report = [
            'totalUlasan' => Ulasan::count(),
            'rataRating' => Ulasan::avg('rating'),
            'bulanIni' => Ulasan::whereMonth('created_at', now()->month)->count(),
        ];

        return view('admin.reports', compact('report'));
    }
}
