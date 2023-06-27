<?php

namespace Modules\Cart\Dto\Cart;

class RemoveItemDto
{
    private int $cartItemId;

    public function __construct(int $cartItemId)
    {
        $this->cartItemId = $cartItemId;
    }

    /**
     * @return int
     */
    public function getCartItemId(): int
    {
        return $this->cartItemId;
    }
}
