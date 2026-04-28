<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'store_name', 'description', 'phone', 'status', 'admin_notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}