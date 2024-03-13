<?php

namespace Modules\Product\Http\Responses;

use App\Models\ProductVendorCodeFeedback;

class FeedbackResponse implements \JsonSerializable
{
    private ProductVendorCodeFeedback $feedback;
    public function __construct(ProductVendorCodeFeedback $feedback)
    {
        $this->feedback = $feedback;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'user' => $this->feedback->user,
            'rating' => $this->feedback->rating,
            'comment' => $this->feedback->comment,
        ];
    }
}
