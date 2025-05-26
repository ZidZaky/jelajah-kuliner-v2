<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PKL extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    // Specify the columns that are mass assignable
    protected $fillable = [
        'namaPKL',
        'desc',
        'latitude',
        'longitude',
        'idAccount'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'idAccount');
    }
}
