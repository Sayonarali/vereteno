<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Category\Http\Requests\ListCategoriesRequest;
use Modules\Category\Http\Responses\CategoryResponse;
use Modules\Category\Http\Responses\ListCategoriesResponse;
use Modules\Category\Services\CategoryService;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(ListCategoriesRequest $request)
    {
        return new ListCategoriesResponse($this->categoryService->index($request->getDto()));
    }

    public function show(Category $category)
    {
        return new CategoryResponse($category);
    }
}
