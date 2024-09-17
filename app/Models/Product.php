<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'productable_id', 'productable_type', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function productable()
    {
        return $this->morphTo();
    }

    public function photos(){
        return $this->hasMany(ProductPhoto::class);
    }
}
