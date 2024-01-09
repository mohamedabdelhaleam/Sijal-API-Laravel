<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getUserCart($cartId)
    {
        $cart = Cart::with('CartItems')->find($cartId);
        if (!$cart) {
            return response()->json([
                'status' => "fail",
                'message' => "Not Found",
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => "success",
            'data' => [
                'cart' => $cart
            ]
        ], 200);
    }
}
