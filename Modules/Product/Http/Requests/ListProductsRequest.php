<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Modules\Product\Dto\FilterDto;
use Modules\Product\Dto\ListProductsDto;

class ListProductsRequest extends FormRequest
{
    public function getDto(): ListProductsDto
    {
        $data = $this->validated();
        return new ListProductsDto(
            $data['limit'],
            $data['offset'],
            $data['orderBy'] ?? '',
            $data['orderDesc'] ?? null,
            $data['priceFrom'] ?? null,
            $data['priceTo'] ?? null,
            $data['search'] ?? '',
            new FilterDto(
                new Collection($data['materials'] ?? []),
                new Collection($data['sizes'] ?? []),
                new Collection($data['colors'] ?? []),
                new Collection($data['attributes'] ?? []),
                new Collection($data['categories'] ?? []),
            )
        );
    }

    public function rules()
    {
        return [
            'limit' => 'required|int|min:1',
            'offset' => 'required|int|min:0',
            'orderBy' => ['nullable', 'string', Rule::in(['price', 'updated_at'])],
            'orderDesc' => 'nullable|bool',
            'priceFrom' => 'nullable|int|min:0',
            'priceTo' => 'nullable|int|min:1',
            'search' => 'nullable|string|max:3000',
            'materials' => 'nullable|array',
            'materials.*' => 'required|int|min:0',
            'sizes' => 'nullable|array',
            'sizes.*' => 'required|int|min:0',
            'colors' => 'nullable|array',
            'colors.*' => 'required|int|min:0',
            'attributes' => 'nullable|array',
            'attributes.*' => 'required|int|min:0',
            'categories' => 'nullable|array',
            'categories.*' => 'required|int|min:0',
        ];
    }
}
