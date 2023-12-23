<?php

namespace Acomics\Ssr\Dto;

class IssueDto
{
	public int $number;

	public ?string $name;

	public string $url;

	public int $width;

	public int $height;

	public function __construct(
		int $number,
		?string $name,
		string $url,
		int $width,
		int $height)
	{
		$this->number = $number;
		$this->name = $name;
		$this->url = $url;
		$this->width = $width;
		$this->height = $height;
	}
}
