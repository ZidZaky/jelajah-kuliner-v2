<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'ulasan',
        'rating',
        'idAccount',
        'idPKL'
    ];

    public function account() // atau user(), sesuaikan dengan nama model Anda
    {
        return $this->belongsTo(User::class, 'idAccount', 'id');
        // 'idAccount' adalah foreign key di tabel ulasans
        // 'id' adalah primary key di tabel users (atau accounts)
    }
}
