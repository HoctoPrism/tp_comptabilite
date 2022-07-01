<?php

namespace App\Models;

use App\Models\Operation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['firstname', 'lastname', 'address', 'postal_code', 'phone', 'email'];

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }
}
