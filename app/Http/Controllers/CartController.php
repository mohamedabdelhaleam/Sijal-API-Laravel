<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartProduct;
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
            ], 404);
        }
        return response()->json([
            'status' => "success",
            'data' => [
                'cart' => $cart
            ]
        ], 200);
    }
    public function addProductToCart(AddProductRequest $request)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        if ($cart) {
            $cartItems = CartItem::create([
                'quantity' => $request->quantity,
                'cart_id' => $cart->id,
                'product_id' => $request->product_id
            ]);
            if ($cartItems) {
                $cartProducts = CartProduct::create([
                    'cart_items_id' => $cartItems->id,
                    'product_id' => $request->product_id
                ]);
                if ($cartProducts) {
                    return response()->json([
                        'status' => "success",
                        'message' => "Product Added Successfully",
                    ], 201);
                } else {
                    return response()->json([
                        'status' => "fail",
                        'message' => "Not Found",
                        'data' => null
                    ], 404);
                }
            } else {
                return response()->json([
                    'status' => "fail",
                    'message' => "Not Found",
                    'data' => null
                ], 404);
            }
        } else {
            return response()->json([
                'status' => "fail",
                'message' => "Not Found",
                'data' => null
            ], 404);
        }
    }
    public function removeProductInCart($productId)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->find($productId);
        $productItem = CartItem::where('cart_id', $cart->id)->find($productId);
        $productCart = CartProduct::where('cart_items_id', $cartItems->id)->find($productId);
        $productItem->delete();
        $productCart->delete();
    }
    public function removeAllProductInCart()
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cart = CartItem::where('cart_id', $cart->id)->first();
    }
    public function updateProductQuantityInCart(Request $request, $productId)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        if ($cart) {
            $product = CartItem::where('cart_id', $cart->id)->find($productId);
            $product->update($request->all());
            return response()->json([
                'status' => "success",
                'message' => "Updated Successfully"
            ], 404);
        } else {
            return response()->json([
                'status' => "fail",
                'message' => "Not Found",
                'data' => null
            ], 404);
        }
    }
}
