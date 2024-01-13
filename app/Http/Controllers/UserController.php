<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers()
    {
        $user = User::get();
        if (!$user) {
            return response()->json([
                'status' => "fail",
                'message' => "Not Found",
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => "success",
            'data' => [
                'user' => $user
            ]
        ], 200);
    }
    public function getUserCart()
    {
        $user = auth()->user();
        //$cart = User::with('Carts.CartItems.Products')->find();
        $cart = Cart::where("user_id", $user->id)->with('CartItems.Products')->get();
        if (!$user) {
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
