<?php

namespace Acomics\Ssr\Dto;

class SerialBannerDto
{
	public string $url;
	public int $width;
	public int $height;

    public function __construct(string $url, int $width, int $height)
    {
        $this->url = $url;
        $this->width = $width;
        $this->height = $height;
    }
}
