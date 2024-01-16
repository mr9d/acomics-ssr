<?php

namespace Acomics\Ssr\Dto;

class SerialChapterDto
{
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
