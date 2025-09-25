<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UlasanController extends Controller
{
    public function index()
    {
        $ulasan = Ulasan::latest()->take(3)->get();
        $totalUlasan = Ulasan::count();
        $averageRating = $totalUlasan > 0 ? Ulasan::avg('rating') : 0;
        $ratingCounts = Ulasan::query()
            ->select('rating', DB::raw('count(*) as total'))
            ->groupBy('rating')
            ->pluck('total', 'rating');

        return view('index', compact(
            'ulasan',
            'totalUlasan',
            'averageRating',
            'ratingCounts'
        ));
    }


    public function loadMore(Request $request)
    {
        $request->validate(['skip' => 'required|integer']);
        $ulasan = Ulasan::latest()
                        ->skip($request->input('skip'))
                        ->take(3)
                        ->get();

        return response()->json($ulasan);
    }


    public function store(Request $request)
    {
        Ulasan::create($request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]));

        return back()->with('success', 'Terima kasih! Ulasan Anda telah berhasil dikirim.');
    }
}