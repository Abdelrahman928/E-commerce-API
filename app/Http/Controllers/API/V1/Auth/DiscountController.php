<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\DiscountRequest;
use App\Http\Resources\api\v1\CategoryResource;
use App\Http\Resources\api\v1\SubCategoryResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
    * admin applies discounts to one or more products or one or more categories.
    *
    * @response 422 {
    *   "error": "validation errors"
    * }
    * @response 200 {
    *   "message": "discount applied successfully"
    * }
    */
    public function addDiscount(DiscountRequest $request){
    $validatedData = $request->validated();

    if (isset($validatedData['product_ids'])) {
        Product::whereIn('id', $validatedData['product_ids'])->update([
            'discount' => $validatedData['discount_percentage'],
            'discount_valid_until' => $validatedData['valid_until']
        ]);
    }

    if (isset($validatedData['category_ids'])) {
        Product::where('productable_type', Category::class)
            ->whereIn('productable_id', $validatedData['category_ids'])
            ->update([
                'discount' => $validatedData['discount_percentage'],
                'discount_valid_until' => $validatedData['valid_until']
            ]);
    }

    if (isset($validatedData['subcategory_ids'])) {
        Product::where('productable_type', SubCategory::class)
            ->whereIn('productable_id', $validatedData['subcategory_ids'])
            ->update([
                'discount' => $validatedData['discount_percentage'],
                'discount_valid_until' => $validatedData['valid_until']
            ]);
    }


        return response()->json(['message' => 'discount applied successfully', 200]);
    }

    public function listDiscountables(){
        $categories = Category::with('products')->get();
        $subCategories = SubCategory::with('products')->get();

        return response()->json([
            'categories' => CategoryResource::collection($categories),
            'subcategories' => SubCategoryResource::collection($subCategories)
        ]);
    }
}