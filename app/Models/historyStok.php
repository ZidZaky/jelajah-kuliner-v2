<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historyStok extends Model
{
    use HasFactory;

    protected $table = 'history_stoks'; // Pastikan ini sesuai

    protected $fillable = [
        'idProduk',
        'idPKL',
        'stokAwal',
        'stokAkhir',
        'TerjualOnline',
        'statusIsi',
    ];
}
