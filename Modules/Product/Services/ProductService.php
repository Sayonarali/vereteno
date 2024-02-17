<?php

namespace Modules\Product\Services;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Color;
use App\Models\Material;
use App\Models\Product;
use App\Models\ProductVendorCode;
use App\Models\Size;
use App\Models\Statpage;
use Modules\Product\Dto\ListProductsDto;
use Modules\Product\Dto\ResultListProductsDto;
use Modules\Product\Dto\ResultListProductVendorCodeDto;

class ProductService
{
    public function index(ListProductsDto $dto)
    {
        $productVendorCodes = ProductVendorCode::query()
            ->when($dto->getFilterDto()->getColors()->isNotEmpty(), function ($query) use ($dto) {
                $query->whereIn('color_id', $dto->getFilterDto()->getColors());
            })
            ->when($dto->getFilterDto()->getMaterials()->isNotEmpty(), function ($query) use ($dto) {
                $query->whereIn('material_id', $dto->getFilterDto()->getMaterials());
            })
            ->whereHas('product', function ($query) use ($dto) {
                $query->when($dto->getFilterDto()->getColors()->isNotEmpty(), function ($query) use ($dto) {
                    $query->whereIn('color_id', $dto->getFilterDto()->getColors());
                });
                $query->when($dto->getFilterDto()->getMaterials()->isNotEmpty(), function ($query) use ($dto) {
                    $query->whereIn('material_id', $dto->getFilterDto()->getMaterials());
                });
//                $query->when($dto->getFilterDto()->getSizes()->isNotEmpty(), function ($query) use ($dto) {
//                    $query->whereIn('size_id', $dto->getFilterDto()->getSizes());
//                });
                $query->whereHas('category', function ($query) use ($dto) {
                    $query->when($dto->getFilterDto()->getCategories()->isNotEmpty(), function ($query) use ($dto) {
                        $allChildrenCategoriesId = [];
                        $categories = Category::whereIn('id', $dto->getFilterDto()->getCategories())->get();
                        foreach ($categories as $category) {
                            Category::allChildrenIds($category, $allChildrenCategoriesId);
                        }
                        $query->whereIn('category_id', array_merge($dto->getFilterDto()->getCategories()->toArray(), $allChildrenCategoriesId));
                    });
                });
                $query->when($dto->getSearch(), function ($query, $search) {
                    $query->where('name', 'LIKE', "%$search%");
                });
            });

        $totalCount = $productVendorCodes->count();
        $productVendorCodes = $productVendorCodes->limit($dto->getLimit())->offset($dto->getOffset())->get();
        /**
         * @todo refactor attribute filter to query view
         */
        if ($dto->getFilterDto()->getAttributes()->isNotEmpty()) {
            $productVendorCodes = $productVendorCodes->filter(function ($productVendorCode) use ($dto) {
                return $productVendorCode->attributes->filter(function ($attribute) use ($dto) {
                    return $dto->getFilterDto()->getAttributes()->contains($attribute->id);
                })->isNotEmpty();
            })->values();
            $totalCount = $productVendorCodes->count();
        }

        return new ResultListProductVendorCodeDto(
            $totalCount,
            $productVendorCodes
        );
    }

    public function showByIds(array $productVendorCodeIds)
    {
        $products = Product::query()
            ->whereHas('codes', function ($query) use ($productVendorCodeIds) {
                $query->whereIn('product_vendor_codes.id', $productVendorCodeIds);
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
