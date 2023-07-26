<?php

namespace Modules\Product\Services;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Color;
use App\Models\Material;
use App\Models\Product;
use App\Models\Size;
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
                $query->when($dto->getFilterDto()->getSizes()->isNotEmpty(), function ($query) use ($dto) {
                    $query->whereIn('size_id', $dto->getFilterDto()->getSizes());
                });
            })
            ->whereHas('category', function ($query) use ($dto) {
                $query->when($dto->getFilterDto()->getCategories()->isNotEmpty(), function ($query) use ($dto) {
                    $query->whereIn('category_id', $dto->getFilterDto()->getCategories());
                });
            })
            ->when($dto->getSearch(), function ($query, $search) {
                $query->where('name', 'LIKE', "%$search%");
            })
            ->when($dto->getSortDesc(), function ($query) use ($dto) {
                $query->orderByDesc($dto->getSortBy());
            });

        $totalCount = $products->count();
        $products = $products->limit($dto->getLimit())->offset($dto->getOffset())->get();

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

//    public function create(Request $request)
//    {
//        $request->validate([
//            'title' => 'bail|required|string|unique:products|max:255',
//            'description' => 'bail|nullable|string|max:255',
//        ]);
//
//        $product = new Product();
//        $product->title = $request->title;
//        if (!empty($request->description)) {
//            $product->description = $request->description;
//        }
//
//        $product->save();
//
//        return response()->json([
//            'product' => $product,
//        ], Response::HTTP_CREATED);
//    }
//
//    public function update(int $id, Request $request)
//    {
//        $request->validate([
//            'title' => 'bail|nullable|string|unique:products|max:255',
//            'description' => 'bail|nullable|string|max:255',
//            'is_discounted' => 'nullable|boolean',
//        ]);
//
//        $product = Product::find($id);
//
//        if (!empty($request->title)) {
//            $product->title = $request->title;
//        }
//        if (!empty($request->description)) {
//            $product->description = $request->description;
//        }
//        if (!empty($request->is_discounted)) {
//            $product->is_discounted = $request->is_discounted;
//        }
//
//        return response()->json([
//            'product' => $product,
//        ], Response::HTTP_OK);
//    }
//
//    public function delete(int $id)
//    {
//        Product::destroy($id);
//
//        return response()->json([
//            'message' => 'deleted'
//        ], Response::HTTP_OK);
//    }
}
