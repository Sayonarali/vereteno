<?php

namespace Modules\Product\Http\Responses;

use App\Models\ProductImage;

class ImageResponse implements \JsonSerializable
{
    private ProductImage $image;
    public function __construct(ProductImage $image)
    {
        $this->image = $image;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'path' => $this->image->disk . $this->image->path,
        ];
    }
}
