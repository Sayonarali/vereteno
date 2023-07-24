<?php

namespace Modules\Product\Http\Responses;

use App\Models\ProductVendorCodeImage;

class ImageResponse implements \JsonSerializable
{
    private ProductVendorCodeImage $image;
    public function __construct(ProductVendorCodeImage $image)
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
