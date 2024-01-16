<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderProduct;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;

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
    public function changeOrderStatus(HttpRequest $request, $orderId, $productId)
    {
        $user = auth()->user();
        $order = Order::where("user_id", $user->id)->find($orderId);
        $orderItems = OrderItem::where("order_id", $order->id)->find($productId);
        if ($orderItems) {
            $orderItems->update($request->all());
            return response()->json([
                'status' => "success",
                'message' => "Updated Successfully"
            ], 200);
        } else {
            return response()->json([
                'status' => "fail",
                'message' => "Can not Update Status",
                'data' => null
            ], 404);
        }
    }
    public function deleteOrder($orderId)
    {
        $user = auth()->user();
        $order = Order::where("user_id", $user->id)->find($orderId);
        $orderItems = OrderItem::where("order_id", $order->id)->find();
    }
}
