<?php

namespace Modules\Product\Dto;

class CreateFeedbackDto
{
    private int $rating;

    private string $comment;

    private int $productVendorCodeId;

    public function __construct(int    $rating,
                                string $comment,
                                int    $productVendorCodeId)
    {
        $this->rating = $rating;
        $this->comment = $comment;
        $this->productVendorCodeId = $productVendorCodeId;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getProductVendorCodeId(): int
    {
        return $this->productVendorCodeId;
    }
}
