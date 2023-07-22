<?php

namespace Modules\Product\Services;

use App\Models\Product;
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
//            ->whereHas('attributes', function ($query) use ($dto) {
//                $query->when($dto->getFilterDto()->getAttributes()->isNotEmpty(), function ($query) use ($dto) {
////                    dd($dto->getFilterDto()->getAttributes());
////                    $dto->getFilterDto()->getAttributes()->map(fn($item) => dd($item));
//                    $query->whereIn('id', $dto->getFilterDto()->getAttributes());
//                });
//            })
            ->when($dto->getSearch(), function ($query, $search) {
                $query->where('name', 'LIKE', "%$search%");
            })
            ->when($dto->getSortDesc(), function ($query) use ($dto) {
                $query->orderByDesc($dto->getSortBy());
            })
            ->limit($dto->getLimit())->offset($dto->getOffset());

        return new ResultListProductsDto(
            Product::all()->count(),
            $products->get()
        );
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
