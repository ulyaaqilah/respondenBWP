<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    // kasih tahu ke Laravel pakai tabel singular
    protected $table = 'ulasan';

    // kolom yang boleh diisi mass-assignment
    protected $fillable = ['nama', 'email', 'rating', 'komentar'];
}

