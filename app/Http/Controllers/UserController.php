<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function update(Request $request)
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        if (!$user) {
            return response()->json([
                'status' => "fail",
                'message' => "Not Found",
                'data' => null
            ], 404);
        }
        $user->update($request->all());
        return response()->json([
            'status' => "success",
            'data' => [
                'user' => $user
            ]
        ], 200);
    }
    public function delete()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        if (!$user) {
            return response()->json([
                'status' => "fail",
                'message' => "Not Found",
                'data' => null
            ], 404);
        }
        $user->delete();
        return response()->json([
            'status' => "success",
            'message' => "Deleted Successfully"
        ], 200);
    }
    public function getUserCart()
    {
        $user = auth()->user();
        //$cart = User::with('Carts.CartItems.Products')->find();
        $cart = Cart::where("user_id", $user->id)->first();
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
