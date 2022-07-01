<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operation extends Model
{
    use HasFactory;
    protected $fillable = ['nature', 'date_operation', 'outcome', 'income', 'category', 'payment', 'client'];

    public function categories()
    {
        return $this->belongsTo(Category::class, "category");
    }

    public function payments()
    {
        return $this->belongsTo(Payment::class, "payment");
    }

    public function clients()
    {
        return $this->belongsTo(Client::class, "client");
    }
}
