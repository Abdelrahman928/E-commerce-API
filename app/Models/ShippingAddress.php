<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'user_id', 'created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
