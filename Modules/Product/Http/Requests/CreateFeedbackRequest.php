<?php

namespace Modules\Product\Http\Requests;

use App\Models\ProductVendorCode;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Product\Dto\CreateFeedbackDto;

class CreateFeedbackRequest extends FormRequest
{
    public function getDto(): CreateFeedbackDto
    {
        $data = $this->validated();
        return new CreateFeedbackDto(
            $data['rating'],
            $data['comment'],
            $data['productVendorCodeId'],
        );
    }

    public function rules()
    {
        return [
            'rating' => 'required|int|min:1',
            'comment' => 'nullable|string|max:300',
            'productVendorCodeId' => 'required|int|exists:' . ProductVendorCode::class . ',id',
        ];
    }
}
