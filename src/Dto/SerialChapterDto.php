<?php

namespace Acomics\Ssr\Dto;

class SerialChapterDto
{
    public const LAYOUT_INHERIT = 0;
    public const LAYOUT_LIST_WITH_IMAGE = 1;
    public const LAYOUT_CENTER_OR_IMAGE = 2;
    public const LAYOUT_INLINE_OR_IMAGE = 3;

	public int $issueNumber;
	public string $name;
	public ?string $about;
	public ?string $imageUrl;
	public int $layout;

	public function __construct(int $issueNumber, string $name, ?string $about, ?string $imageUrl, int $layout)
	{
		$this->issueNumber = $issueNumber;
		$this->name = $name;
		$this->about = $about;
		$this->imageUrl = $imageUrl;
		$this->layout = $layout;
	}
}
