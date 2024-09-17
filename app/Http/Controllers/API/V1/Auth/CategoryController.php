<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\AddToCartRequest;
use App\Http\Requests\api\v1\CategoryRequest;
use App\Http\Resources\api\v1\CategoryResource;
use App\Http\Resources\api\v1\ProductIndexResource;
use App\Http\Resources\api\v1\ProductShowResource;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function create(CategoryRequest $request){
        Category::create($request->validated());

        cache::tags(['categories_with_subcategories_and_products'])->flush();

        return response()->json(['message' => 'category added successfully', 200]);
    }

    public function index(){

        $cacheKey = 'categories_with_subcategories';
        $cacheTime = now()->addMinutes(60);

        $categories = Cache::tags(['categories_with_subcategories_and_products'])
                        ->remember($cacheKey, $cacheTime, function () {
            return Category::with('subcategories', 'products')->get();
        });

        if($categories->isEmpty()){
            return null;
        }

        $filteredCategories = $categories->map(function ($category) {
            if ($category->subcategories->isNotEmpty()) {
                return new CategoryResource($category);
            }
            return null;

            if ($category->products->isNotEmpty()) {
                return new CategoryResource($category->only(['id', 'name']));
            }
            return null;
        })->filter();

        return CategoryResource::collection($filteredCategories);
    }

    public function showCategory(Category $category){
        $cacheKey = 'category_' . $category->id;
        $cacheTime = now()->addMinutes(10);
        
        $products = Cache::tags(['categories_with_subcategories_and_products'])
                      ->remember($cacheKey, $cacheTime, function() use($category){
            return Product::where('productable_type', Category::class)
                       ->where('productable_id', $category->id)
                       ->with('photos')
                       ->paginate(9);
        });

        if($products->isEmpty()){
            return null;
        }

        return ProductIndexResource::collection($products);
    }

    public function showProduct(Category $category, Product $product){
        if ($product->productable_type === Category::class) {
            if ($product->productable_id !== $category->id) {
                return response()->json([
                    'status' => 404,
                    'error' => 'product not found in this category'], 404);
            }
        }  else {
            return response()->json([
                'status' => 404,
                'error' => 'NOT FOUND'], 404);
        }

        return new ProductShowResource($product);
    }

    public function addProductToCart(Category $category, SubCategory $subCategory, Product $product, AddToCartRequest $request){
        $validated = $request->validated();
        $user = Auth::user();
        $cart = $user->cart()->first([]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product)
            ->first();

        $subtotal = $product->price_after_discount * $validated['quantity'];

        if ($cartItem->isNotEmpty()) {
            $cartItem->quantity += $validated['quantity'];
            $cartItem->subtotal = $product->price * $cartItem->quantity;
            $cartItem->save();
        }

        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => $cartItem['quantity'],
            'price' => $product->price,
            'subtotal' => $subtotal,
            'name' => $product->name,
            'thumbnail' => $product->photos->first() ? $product->photos->first()->photo_path : null,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Product added to cart successfully.'], 200);
    }

    public function destroyCategory(Category $category){
        $category->delete();

        cache::tags(['categories_with_subcategories_and_products'])->flush();

        return response()->json([
            'status' => 200,
            'message' => 'category removed successfully'], 200);
    }
}
