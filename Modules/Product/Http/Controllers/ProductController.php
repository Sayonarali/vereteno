<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\Statpage;
use Modules\Product\Http\Requests\ListProductsRequest;
use Modules\Product\Http\Requests\ShowByIdsRequest;
use Modules\Product\Http\Responses\AttributeResponse;
use Modules\Product\Http\Responses\BannerResponse;
use Modules\Product\Http\Responses\ListProductsResponse;
use Modules\Product\Http\Responses\ProductResponse;
use Modules\Product\Services\ProductService;

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

    public function showByIds(ShowByIdsRequest $request)
    {
        return new ListProductsResponse($this->productService->showByIds($request->getProductVendorCodeIds()));
    }

    public function getBanner()
    {
        return $this->productService->getBanner()->map(fn(Statpage $banner) => new BannerResponse($banner));
    }


    public function getAttributes()
    {
        return $this->productService->getAttributes()->map(fn(Attribute $attribute) => new AttributeResponse($attribute));
    }

    public function getColors()
    {
        return $this->productService->getColors();
    }

    public function getMaterials()
    {
        return $this->productService->getMaterials();
    }

    public function getSizes()
    {
        return $this->productService->getSizes();
    }
}
