<?php

namespace Modules\Product\Http\Responses;

use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductVendorCode;
use App\Models\ProductVendorCodeFeedback;
use App\Models\ProductVendorCodeImage;
use App\Models\Size;
use App\Models\VendorCode;

class ProductVendorCodeResponse implements \JsonSerializable
{
    private ProductVendorCode $productVendorCode;

    public function __construct(ProductVendorCode $productVendorCode)
    {
        $this->productVendorCode = $productVendorCode;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->productVendorCode->id,
            'name' => $this->productVendorCode->product->name,
            'description' => $this->productVendorCode->product->description,
            'slug' => $this->productVendorCode->product->slug,
            'category' => $this->productVendorCode->product->category ? new CategoryResponse($this->productVendorCode->product->category) : null,
            'discount' => $this->productVendorCode->discount ? $this->productVendorCode->discount->discount_coefficient : null,
            'price' => $this->productVendorCode->price,
            'vendorCode' => $this->productVendorCode->code ? new VendorCodeResponse($this->productVendorCode->code) : null,
            'sizes' => $this->productVendorCode->sizes->map(fn(Size $size) => new SizeResponse($size)),
            'images' => $this->productVendorCode->images->map(fn(ProductVendorCodeImage $image) => new ImageResponse($image)),
            'attributes' => $this->productVendorCode->attributes->map(fn(AttributeValue $attributeValue) => new AttributeValueResponse($attributeValue)),
            'feedbacks' => $this->productVendorCode->feedbacks->map(fn(ProductVendorCodeFeedback $feedback) => new FeedbackResponse($feedback))
        ];
    }
}
