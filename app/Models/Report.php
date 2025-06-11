<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'idPengguna',
        'idPelapor',
        'idPesanan',
        'alasan',
    ];

    /**
     * Mendefinisikan relasi ke Akun yang dilaporkan.
     */
    public function reportedUser()
    {
        return $this->belongsTo(Account::class, 'idPengguna');
    }

    /**
     * Mendefinisikan relasi ke PKL yang melapor.
     */
    public function reporterPkl()
    {
        return $this->belongsTo(PKL::class, 'idPelapor');
    }
}
