<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAllProduct()
    {
        $product = Product::with('Reviews')->get();
        if (!$product) {
            return response()->json([
                'status' => "fail",
                'data' => [
                    'product' => 'No Product'
                ]
            ], 204);
        }
        return response()->json([
            'status' => "success",
            'data' => [
                'products' => $product
            ]
        ], 200);
    }
    public function getSingleProduct($productId)
    {
        $product = Product::find($productId);
        if (!$product) {
            return response()->json([
                'status' => "fail",
                'message' => "Not Found",
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => "success",
            'data' => [
                'product' => $product
            ]
        ], 200);
    }
    public function createProduct(ProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        if (!$product) {
            return response()->json([
                'status' => "fail",
                'message' => "Product Created Faild",
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => "success",
            'message' => "Product Created Successfully",
            'data' => [
                'product' => $product
            ]
        ], 201);
    }
    public function updateProduct(ProductRequest $request, $productId)
    {
        $product = Product::find($productId);
        if (!$product) {
            return response()->json([
                'status' => "fail",
                'message' => "Not Found",
                'data' => null
            ], 404);
        }
        $product->update($request->all());
        return response()->json([
            'status' => "success",
            'message' => "Product Updated Successfully",
            'data' => [
                'product' => $product
            ]
        ], 200);
    }
    public function deleteProduct($productId)
    {
        $product = Product::find($productId);
        if (!$product) {
            return response()->json([
                'status' => "fail",
                'message' => "Not Found",
                'data' => null
            ], 404);
        }
        $product->delete();
        return response()->json([
            'status' => "success",
            'message' => "Product Deleted Successfully",
            'data' => null
        ], 200);
    }
}
