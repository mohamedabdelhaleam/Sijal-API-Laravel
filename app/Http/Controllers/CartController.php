<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function getCart()
    {

        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id)->with('CartItems.Products')->first();
        if (!$cart) {
            return response()->json([
                'status' => "fail",
                'message' => "Not Found",
                'data' => null
            ], 201);
        }
        return response()->json([
            'status' => "success",
            'data' => [
                'cart' => $cart
            ]
        ], 200);
    }
}
