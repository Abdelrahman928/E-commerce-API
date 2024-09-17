<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
  
    public function getRouteKeyName()
    {
        return 'name';
    }

    public function products(){
        return $this->morphMany(Product::class, 'productable');
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
