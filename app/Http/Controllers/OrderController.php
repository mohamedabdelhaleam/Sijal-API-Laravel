<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function getOrder()
    {
        $user = auth()->user();
        $order = Order::where("user_id", $user->id)->with('OrderItems')->get();
        if (!$order) {
            return response()->json([
                'status' => "fail",
                'message' => "Not Found",
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => "success",
            'data' => [
                'user' => $order
            ]
        ], 200);
    }
    public function getOrdersWithProducts()
    {
        $user = auth()->user();
        $order = Order::where("user_id", $user->id)->with('OrderItems.Products')->get();
        if (!$order) {
            return response()->json([
                'status' => "fail",
                'message' => "Not Found",
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => "success",
            'data' => [
                'user' => $order
            ]
        ], 200);
    }
    public function createOrder()
    {
        $user = auth()->user();
        $order = Order::create([
            'total_amount' => 200,
            'status' => "wait",
            'user_id' => $user->id,
        ]);
        if (!$order) {
            return response()->json([
                'status' => "fail",
                'message' => "Can not Create Order",
                'data' => null
            ], 404);
        } else {
            $cartItems = Cart::where('user_id', $user->id)->with("CartItems")->get();
            foreach ($cartItems as $cartItem) {
                $orderItems = OrderItem::with('Products')->create([
                    'quantity' => 10,
                    'order_id' => $order->id,
                    'product_id' => 10,
                ]);
            }
        }
    }
}
