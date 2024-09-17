<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\CategoryRequest;
use App\Http\Resources\api\v1\ProductIndexResource;
use App\Http\Resources\api\v1\ProductShowResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Cache;

class SubCategoryController extends Controller
{
    public function create(CategoryRequest $request){
        SubCategory::create($request->validated());

        Cache::tags(['categories_with_subcategories_and_products'])->flush();

        return response()->json(['message' => 'sub-category added successfully', 200]);
    }

    public function showSubCategory(Category $category, SubCategory $subCategory){
        $cacheKey = 'sub_category_' . $subCategory->id;
        $cacheTime = now()->addMinutes(10);
        
        $products = Cache::tags(['categories_with_subcategories_and_products'])
                      ->remember($cacheKey, $cacheTime, function() use($subCategory){
            return Product::where('productable_type', SubCategory::class)
                       ->where('productable_id', $subCategory->id)
                       ->with('photos')
                       ->paginate(9);
        });

        if($products->isEmpty()){
            return null;
        }

        return ProductIndexResource::collection($products);
    }

    public function showProduct(Category $category, SubCategory $subCategory, Product $product){
        if ($product->productable_type === SubCategory::class) {
            if ($product->productable_id !== $subCategory->id || $subCategory->category_id !== $category->id)  {
                return response()->json([
                    'status' => 404,
                    'error' => 'product not found in this category'], 404);
            }
        } else {
            return response()->json([
                'status' => 404,
                'error' => 'NOT FOUND'], 404);
        }
        return new ProductShowResource($product);
    }

    public function destroySubCategory(SubCategory $subCategory){
        $subCategory->delete();

        cache::tags(['categories_with_subcategories_and_products'])->flush();

        return response()->json([
            'status' => 200,
            'message' => 'category removed successfully'], 200);
    }
}
