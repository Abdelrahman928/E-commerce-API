<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'category_id', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'name';
    }
    
    public function products(){
        return $this->morphMany(Product::class, 'productable');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
