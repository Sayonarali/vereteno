<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Product\Entities\Category;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::all();

        return response()->json([
            'categories' => $categories,
        ],Response::HTTP_OK);
    }

    public function show(int $id): JsonResponse
    {
        $category = Category::find($id);

        return response()->json([
            'category' => $category,
        ],Response::HTTP_OK);
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'bail|required|string|unique:categories|max:255',
            'type' => 'bail|nullable|string|max:255'
        ]);

        $category = new Category();
        $category->name = $request->name;
        if(!empty($request->type)){
            $category->type = $request->type;
        }

        $category->save();

        return response()->json([
            'category' => $category,
        ],Response::HTTP_CREATED);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'bail|nullable|string|unique:categories|max:255',
            'type' => 'bail|nullable|string|max:255'
        ]);

        $category = Category::find($id);

        if(!empty($request->name)){
            $category->name = $request->name;
        }
        if(!empty($request->type)){
            $category->type = $request->type;
        }

        return response()->json([
            'category' => $category,
        ],Response::HTTP_OK);
    }

    public function delete(int $id): JsonResponse
    {
        Category::destroy($id);

        return response()->json([
            'message' => 'deleted'
        ], Response::HTTP_OK);
    }
}
