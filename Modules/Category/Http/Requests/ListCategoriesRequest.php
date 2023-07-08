<?php

namespace Modules\Category\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Category\Dto\ListCategoriesDto;

class ListCategoriesRequest extends FormRequest
{
    public function getDto()
    {
        $data = $this->validated();
        return new ListCategoriesDto($data['limit'],
            $data['offset'],
            $data['level'] ?? null,
            $data['parent'] ?? null,
        );
    }

    public function rules()
    {
        return [
            'limit' => 'required|int|min:1',
            'offset' => 'required|int|min:0',
            'level' => 'nullable|int|exists:' . Category::class . ',level',
            'parent' => 'nullable|int|exists:' . Category::class . ',id',
        ];
    }
}
