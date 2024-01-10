<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getOneCart($cartId)
    {
        $cart = Cart::with('cartItems.Products')->find($cartId);
        if (!$cart) {
            return response()->json([
                'status' => "fail",
                'message' => "Not Found",
                'data' => null
            ], 201);
        }
        return response()->json([
            'status' => "success",
            'message' => null,
            'data' => [
                'cart' => $cart
            ]
        ], 200);
    }
}
