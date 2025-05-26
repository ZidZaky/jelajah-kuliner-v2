<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
    // Specify the columns that are mass assignable
    protected $fillable = [
        'namaProduk', 'desc', 'harga', 'stokSaatIni', 'jenisProduk', 'fotoProduk', 'idPKL'
    ];

    protected $nullable = [
        'fotoProduk'
    ];

    public function pkl()
    {
        return $this->belongsTo(PKL::class, 'idPKL'); // sesuaikan nama kolom
    }

    public function pesanans()
    {
        return $this->belongsToMany(Pesanan::class, 'produk_dipesan', 'idProduk', 'idPesanan')
                    ->withPivot('JumlahProduk');
    }
}
