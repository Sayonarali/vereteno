<?php

namespace Modules\Product\Http\Responses;

use App\Models\Statpage;

class BannerResponse implements \JsonSerializable
{
    private Statpage $banner;

    public function __construct(Statpage $banner)
    {
        $this->banner = $banner;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->banner->id,
            'alias' => $this->banner->alias,
            'title' => $this->banner->title,
            'content' => $this->banner->content,
            'image' => $this->banner->path,
            'metaDescription' => $this->banner->meta_description,
            'metaKeywords' => $this->banner->meta_keywords,
        ];
    }
}
