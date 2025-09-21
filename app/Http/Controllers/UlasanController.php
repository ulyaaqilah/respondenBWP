<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function index()
    {
        $ulasan = Ulasan::latest()->get();
        return view('index', compact('ulasan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'nullable|email',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required'
        ]);

        Ulasan::create($request->all());

        return redirect('/')->with('success', 'Terima kasih atas ulasan Anda!');
    }
}
