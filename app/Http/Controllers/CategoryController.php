<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategory()
    {
        $category = Category::with('Products')->get();
        if (!$category) {
            return response()->json([
                'status' => "fail",
                'data' => [
                    'category' => 'No Content'
                ]
            ], 204);
        }
        return response()->json([
            'status' => "success",
            'data' => [
                'categories' => $category
            ]
        ], 200);
    }
    public function getSingleCategory($categoryId)
    {
        $category = Category::with('Products')->find($categoryId);
        if (!$category) {
            return response()->json([
                'status' => "fail",
                'message' => "Not Found",
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => "success",
            'data' => [
                'category' => $category
            ]
        ], 200);
    }
    public function createCategory(CategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        if (!$category) {
            return response()->json([
                'status' => "fail",
                'message' => "Category Created Faild",
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => "success",
            'message' => "Category Created Successfully",
            'data' => [
                'category' => $category
            ]
        ], 201);
    }
    public function updateCategory(CategoryRequest $request, $categoryId)
    {
        $category = Category::find($categoryId);
        if (!$category) {
            return response()->json([
                'status' => "fail",
                'message' => "Not Found",
                'data' => null
            ], 404);
        }
        $category->update($request->all());
        return response()->json([
            'status' => "success",
            'message' => "Category Updated Successfully",
            'data' => [
                'category' => $category
            ]
        ], 200);
    }
    public function deleteCategory($categoryId)
    {
        $category = Category::find($categoryId);
        if (!$category) {
            return response()->json([
                'status' => "fail",
                'message' => "Not Found",
                'data' => null
            ], 404);
        }
        $category->delete();
        return response()->json([
            'status' => "success",
            'message' => "Category Deleted Successfully",
            'data' => null
        ], 200);
    }
}
