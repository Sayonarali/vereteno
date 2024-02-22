<?php

namespace Modules\Product\Services;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Color;
use App\Models\Material;
use App\Models\ProductVendorCode;
use App\Models\Size;
use App\Models\Statpage;
use Modules\Product\Dto\ListProductsDto;
use Modules\Product\Dto\ResultListProductVendorCodeDto;

class ProductService
{
    public function index(ListProductsDto $dto)
    {
        $productVendorCodes = ProductVendorCode::query()
            ->whereHas('code', function ($query) use ($dto) {
                $query->when($dto->getFilterDto()->getColors()->isNotEmpty(), function ($query) use ($dto) {
                    $query->whereIn('color_id', $dto->getFilterDto()->getColors());
                });
                $query->when($dto->getFilterDto()->getMaterials()->isNotEmpty(), function ($query) use ($dto) {
                    $query->whereIn('material_id', $dto->getFilterDto()->getMaterials());
                });
            })
            ->whereHas('product', function ($query) use ($dto) {
                $query->whereHas('category', function ($query) use ($dto) {
                    $query->when($dto->getFilterDto()->getCategories()->isNotEmpty(), function ($query) use ($dto) {
                        $allChildrenCategoriesId = [];
                        $categories = Category::whereIn('id', $dto->getFilterDto()->getCategories())->get();
                        foreach ($categories as $category) {
                            $allChildrenCategoriesId = $category->getAllChildrenCategories()->pluck('id')->all();
                        }
                        $query->whereIn('category_id', array_merge($dto->getFilterDto()->getCategories()->toArray(), $allChildrenCategoriesId));
                    });
                });
                $query->when($dto->getSearch(), function ($query, $search) {
                    $query->where('name', 'LIKE', "%$search%");
                });
            })
            ->when($dto->getPriceFrom(), function ($query) use ($dto) {
                $query->where('price', '>=', $dto->getPriceFrom());
            })
            ->when($dto->getPriceTo(), function ($query) use ($dto) {
                $query->where('price', '<=', $dto->getPriceTo());
            })
            ->whereHas('sizes', function ($query) use ($dto) {
                $query->when($dto->getFilterDto()->getSizes()->isNotEmpty(), function ($query) use ($dto) {
                    $query->whereIn('id', $dto->getFilterDto()->getSizes());
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
        $productVendorCodes = ProductVendorCode::whereIn('id', $productVendorCodeIds)->get();

        return new ResultListProductVendorCodeDto(
            $productVendorCodes->count(),
            $productVendorCodes
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
