<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    use HasFactory;

    protected $guarded = [
        'id'
    ];

    // Specify the columns that are mass assignable
    protected $fillable = [
        'idPKL', 'idAccount', 'Keterangan', 'status'
    ];

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'produk_dipesan', 'idPesanan', 'idProduk')
                    ->withPivot('JumlahProduk');
    }
}
