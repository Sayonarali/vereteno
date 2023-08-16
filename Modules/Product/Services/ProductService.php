<?php

namespace Modules\Product\Services;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Color;
use App\Models\Material;
use App\Models\Product;
use App\Models\Size;
use App\Models\Statpage;
use Modules\Product\Dto\ListProductsDto;
use Modules\Product\Dto\ResultListProductsDto;

class ProductService
{
    public function index(ListProductsDto $dto)
    {
        $products = Product::query()
            ->whereHas('codes', function ($query) use ($dto) {
                $query->when($dto->getFilterDto()->getColors()->isNotEmpty(), function ($query) use ($dto) {
                    $query->whereIn('color_id', $dto->getFilterDto()->getColors());
                });
                $query->when($dto->getFilterDto()->getMaterials()->isNotEmpty(), function ($query) use ($dto) {
                    $query->whereIn('material_id', $dto->getFilterDto()->getMaterials());
                });
//                $query->when($dto->getFilterDto()->getSizes()->isNotEmpty(), function ($query) use ($dto) {
//                    $query->whereIn('size_id', $dto->getFilterDto()->getSizes());
//                });
//                $query->when($dto->getSortDesc(), function ($query) use ($dto) {
//                    $query->orderByDesc($dto->getSortBy());
//                });
            })
            ->whereHas('category', function ($query) use ($dto) {
                $query->when($dto->getFilterDto()->getCategories()->isNotEmpty(), function ($query) use ($dto) {
                    $query->whereIn('category_id', $dto->getFilterDto()->getCategories());
                });
            })
//            ->when($dto->getSortDesc(), function ($query) use ($dto) {
//                $query->join('product_vendor_codes', 'product_vendor_codes.product_id', '=', 'products.id')
//                    ->orderByDesc('product_vendor_codes.price')->select('products.*');
//            })
            ->when($dto->getSearch(), function ($query, $search) {
                $query->where('name', 'LIKE', "%$search%");
            });

        $totalCount = $products->count();
        $products = $products->limit($dto->getLimit())->offset($dto->getOffset())->get()
            ->sortBy(function ($product) {
                return $product->codes->max->price;
            });
        /**
         * @todo refactor attribute filter to query view
         */
        if ($dto->getFilterDto()->getAttributes()->isNotEmpty()) {
            $products = $products->filter(function ($product) use ($dto) {
                return $product->codes->filter(function ($code) use ($dto) {
                    return $code->pivot->attributes->filter(function ($attribute) use ($dto) {
                        return $dto->getFilterDto()->getAttributes()->contains($attribute->id);
                    })->isNotEmpty();
                })->isNotEmpty();
            })->values();
            $totalCount = $products->count();
        }

        return new ResultListProductsDto(
            $totalCount,
            $products
        );
    }

    public function showByIds(array $productVendorCodeIds)
    {
        $products = Product::query()
            ->whereHas('codes', function ($query) use ($productVendorCodeIds) {
                $query->whereIn('id', $productVendorCodeIds);
            })
            ->get();

        $totalCount = $products->count();

        return new ResultListProductsDto(
            $totalCount,
            $products
        );
    }

    public function getBanner()
    {
        return Statpage::query()->where('alias', 'banner')->get();
    }

    public function getAttributes()
    {
        return Attribute::query()->with('values')->get();
    }

    public function getColors()
    {
        return Color::all();
    }

    public function getMaterials()
    {
        return Material::all();
    }

    public function getSizes()
    {
        return Size::all();
    }
}
