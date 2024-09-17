<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\AddToCartRequest;
use App\Http\Resources\api\v1\CartItemResource;
use App\Http\Resources\api\v1\ProductShowResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $user = Auth::user();
        $this->authorize('viewAny', CartItem::class);
        $cartItem = CartItem::where('cart_id', $user->cart->id)->paginate(9);

        if ($cartItem->isEmpty()) {
            return response()->json(['message' => 'Your cart is empty.'], 404);
        }

        $totalSubtotal = $cartItem->sum('subtotal');
    
        return response()->json([
            'cart_items' => CartItemResource::collection($cartItem),
            'total_subtotal' => $totalSubtotal
        ]);
    }

    public function show(CartItem $cartItem){
        $product = Product::findOrFail($cartItem->product_id);
        $this->authorize('view', $cartItem);

        return new ProductShowResource($product);
    }

    /**
    * updates item's quantity inside user's cart.
    *
    * @response 422 {
    *   "error": "validation errors"
    * }
    * @response 200 {
    *   "message": "item updated successfully"
    * }
    */
    public function update(AddToCartRequest $request, CartItem $cartItem){
        $this->authorize('update', $cartItem);
        $validated = $request->validated();
        $subtotal = $validated['quantity'] * $cartItem->price;

        $cartItem->update([
            'quantity' => $validated->quantity,
            'subtotal' => $subtotal
        ]);

        return response()->json(['message' => 'item updated successfully', 200]);
    }

    /**
    * removes an item from user's cart.
    *
    * @response 200 {
    *   "message": "item removed from cart successfully"
    * }
    */
    public function destroy(CartItem $cartItem){
        $this->authorize('destroy', $cartItem);

        $cartItem->delete();

        return response()->json(['message' => 'item removed from cart successfully']);
    }
}
