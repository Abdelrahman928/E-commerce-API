<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'cart_id', 'product_id', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
