<?php

namespace App\Http\Controllers;

use App\Models\User;
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
}
