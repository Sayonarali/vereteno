<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Product\Http\Requests\ListProductsRequest;
use Modules\Product\Http\Responses\ListProductsResponse;
use Modules\Product\Http\Responses\ProductResponse;
use Modules\Product\Services\ProductService;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(ListProductsRequest $request)
    {
        return new ListProductsResponse($this->productService->index($request->getDto()));
    }

    public function show(Product $product)
    {
        return new ProductResponse($product);
    }
//
//    public function create(CreateUpdateProductRequest $request)
//    {
//
//    }
//
//    public function update(Product $product, CreateUpdateProductRequest $request)
//    {
//
//    }
//
//    public function delete(Product $product)
//    {
//
//    }
}
