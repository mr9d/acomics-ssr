<?php

namespace Acomics\Ssr\Dto;

class CoverDto
{
    public string $imageUrl;

    public string $linkTitle;

    public ?string $linkUrl;

    public function __construct(
        string $imageUrl,
        string $linkTitle,
        ?string $linkUrl,
    )
    {
        $this->imageUrl = $imageUrl;
        $this->linkTitle = $linkTitle;
        $this->linkUrl = $linkUrl;
    }
}
