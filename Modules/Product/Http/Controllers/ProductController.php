<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\ProductVendorCode;
use App\Models\Statpage;
use Modules\Product\Http\Requests\ListProductsRequest;
use Modules\Product\Http\Requests\ShowByIdsRequest;
use Modules\Product\Http\Responses\AttributeResponse;
use Modules\Product\Http\Responses\BannerResponse;
use Modules\Product\Http\Responses\ListProductVendorCodesResponse;
use Modules\Product\Http\Responses\ProductVendorCodeResponse;
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
        return new ListProductVendorCodesResponse($this->productService->index($request->getDto()));
    }

    public function show(ProductVendorCode $productVendorCode)
    {
        return new ProductVendorCodeResponse($productVendorCode);
    }

    public function showByIds(ShowByIdsRequest $request)
    {
        return new ListProductVendorCodesResponse($this->productService->showByIds($request->getProductVendorCodeIds()));
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
