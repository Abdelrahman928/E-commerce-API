<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'user_id', 'shipping_address_id', 'created_at', 'updated_at'];

    public function orderItem (){
        return $this->hasMany(OrderItem::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function shipping(){
        return $this->belongsTo(ShippingAddress::class);
    }
}
