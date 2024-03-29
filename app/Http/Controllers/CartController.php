<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartProduct;
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
        $cartItems = CartItem::create([
            'quantity' => $request->quantity,
            'cart_id' => $cart->id,
            'product_id' => $request->product_id
        ]);
        $cartProducts = CartProduct::create([
            'cart_items_id' => $cartItems->id,
            'product_id' => $request->product_id
        ]);
        if ($cartItems && $cartProducts) {
            return response()->json([
                'status' => "success",
                'message' => "Product Added Successfully",
            ], 201);
        } else {
            return response()->json([
                'status' => "fail",
                'message' => "Can not Add Product To Cart",
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
        if ($productItem && $productCart) {
            $productItem->delete();
            $productCart->delete();
            return response()->json([
                'status' => "success",
                'message' => "Updated Successfully"
            ], 200);
        } else {
            return response()->json([
                'status' => "fail",
                'message' => "Can not Delete Product",
                'data' => null
            ], 404);
        }
    }


    public function removeAllProductInCart()
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->first();
        $cartProducts = CartProduct::where('cart_items_id', $cartItems->id)->first();
        foreach ($cartItems as $cartItem) {
            $cartItem->delete();
        }
        foreach ($cartProducts as $cartProduct) {
            $cartProduct->delete();
        }
        return response()->json([
            'status' => "success",
            'message' => "Deleted Successfully",
            'data' => null
        ], 200);
    }


    public function updateProductQuantityInCart(Request $request, $productId)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        $product = CartItem::where('cart_id', $cart->id)->find($productId);
        if ($product) {
            $product->update($request->all());
            return response()->json([
                'status' => "success",
                'message' => "Updated Successfully"
            ], 200);
        } else {
            return response()->json([
                'status' => "fail",
                'message' => "Can not Update Quantity",
                'data' => null
            ], 404);
        }
    }
}
