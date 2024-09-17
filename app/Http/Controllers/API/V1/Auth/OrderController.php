<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\AcceptedPaymentMethodResource;
use App\Http\Resources\api\v1\CartItemResource;
use App\Http\Resources\api\v1\ShippingAddressResource;
use App\Models\AcceptedPaymentMethods;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $user = Auth::user();
        $cartItem = CartItem::where('cart_id', $user->cart->id)->get();
        $total = $cartItem->sum('subtotal');
        $shipping = $user->shippingAddress()->get();
        $paymentMethod = AcceptedPaymentMethods::all();

        if ($cartItem->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'Your cart is empty.'], 404);
        }

        if ($shipping->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'Add shipping address'], 404);
        }

        return response()->json([
            'cart_items' => CartItemResource::collection($cartItem),
            'total_price' => $total,
            'shipping_address' => ShippingAddressResource::collection($shipping),
            'payment_methods' => AcceptedPaymentMethodResource::collection($paymentMethod)
        ]);
    }

    public function payment(){
        //stripe logic here
    }
}
