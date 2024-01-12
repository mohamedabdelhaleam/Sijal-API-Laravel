<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getUserOrder()
    {
        $order = User::with('Orders.OrderItems')->find(auth()->user());
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
        if ($user) {
            $order = Order::create([
                'total_amount' => 200,
                'status' => "wait",
                'user_id' => $user->id,
            ]);
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
                    'order' => $order
                ]
            ], 201);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
