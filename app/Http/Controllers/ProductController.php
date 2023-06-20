<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::all();

        return response()->json([
            'products' => $products,
        ],Response::HTTP_OK);
    }

    public function show(int $id): JsonResponse
    {
        $product = Product::find($id);

        return response()->json([
            'product' => $product,
        ],Response::HTTP_OK);
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'bail|required|string|unique:products|max:255',
            'description' => 'bail|nullable|string|max:255',
        ]);

        $product = new Product();
        $product->title = $request->title;
        if(!empty($request->description)){
            $product->description = $request->description;
        }

        $product->save();

        return response()->json([
            'product' => $product,
            ],Response::HTTP_CREATED);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'bail|nullable|string|unique:products|max:255',
            'description' => 'bail|nullable|string|max:255',
            'is_discounted' => 'nullable|boolean',
        ]);

        $product = Product::find($id);

        if(!empty($request->title)){
            $product->title = $request->title;
        }
        if(!empty($request->description)){
            $product->description = $request->description;
        }
        if(!empty($request->is_discounted)){
            $product->is_discounted = $request->is_discounted;
        }

        return response()->json([
            'product' => $product,
        ],Response::HTTP_OK);
    }

    public function delete(int $id): JsonResponse
    {
        Product::destroy($id);

        return response()->json([
            'message' => 'deleted'
        ], Response::HTTP_OK);
    }
}
