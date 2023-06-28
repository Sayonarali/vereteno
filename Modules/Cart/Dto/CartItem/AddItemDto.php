<?php

namespace Modules\Cart\Dto\CartItem;

class AddItemDto
{
    private int $productId;

    public function __construct(int $productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }
}
