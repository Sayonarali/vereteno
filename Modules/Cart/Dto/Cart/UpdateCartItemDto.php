<?php

namespace Modules\Cart\Dto\Cart;

class UpdateCartItemDto
{
    private int $productId;
    private int $quantity;

    public function __construct(int $productId, int $quantity)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
