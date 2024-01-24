<?php

namespace Acomics\Ssr\Dto;

class SerialCharacterDto
{
    public string $name;
	public ?string $about;
	public ?string $imageUrl;
	public ?string $thumbUrl;

    public function __construct(
        string $name,
	    ?string $about,
	    ?string $imageUrl,
	    ?string $thumbUrl,
    )
    {
        $this->name = $name;
        $this->about = $about;
        $this->imageUrl = $imageUrl;
        $this->thumbUrl = $thumbUrl;
    }
}
