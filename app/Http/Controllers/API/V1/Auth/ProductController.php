<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\ProductRequest;
use App\Http\Resources\api\v1\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPhoto;

class ProductController extends Controller
{
    /**
    * admin creates a new product.
    *
    * @response 422 {
    *   "error": "validation errors"
    * }
    * @response 200 {
    *   "message": "new product created successfully"
    * }
    */
    public function create(ProductRequest $request){
        $product = Product::create($request->validated());

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('product_photos', 'public');
    
                ProductPhoto::create(['photo_path' => $path]);
            }
        }

        return response()->json([
            'status' => 200,
            'message' => 'new product created successfully',
             $product], 200);
    }

    public function allCategoriesWithSubcategories()
    {
        $categories = Category::with('subCategories')->get();

        return CategoryResource::collection($categories);
    }

    /**
    * admin updates an existing product.
    *
    * @response 422 {
    *   "error": "validation errors"
    * }
    * @response 200 {
    *   "message": "product updated successfully"
    * }
    */
    public function update(ProductRequest $request, Product $product){
        $product->update($request->validated()); 

        return response()->json([
            'status' => 200,
            'message' => 'product updated successfully',
            $product], 200);
    }

    /**
    * admin deletes a product.
    *
    * @response 200 {
    *   "message": "product deleted successfully"
    * }
    */
    public function destroy(Product $product){
        $product->delete();

        return response()->json([
            'status' => 200,
            'message' => 'product deleted successfully'], 200);
    }
}

