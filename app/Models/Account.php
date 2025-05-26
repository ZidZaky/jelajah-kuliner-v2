<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
class Account extends Model implements Authenticatable
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    // Specify the table name if it's different from the default 'accounts' table
     protected $table = 'accounts';

    // Specify the primary key column if it's different from the default 'id' column
    protected $primaryKey = 'id';

    // Specify the columns that are mass assignable
    protected $fillable = [
        'nama', 'email', 'nohp', 'password', 'status'
    ];

    // Specify the columns that should be hidden from JSON serialization
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Implement the methods required by the Authenticatable interface

    public function getAuthIdentifierName()
    {
        return 'id'; // Assuming 'id' is the name of the primary key column
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

}
