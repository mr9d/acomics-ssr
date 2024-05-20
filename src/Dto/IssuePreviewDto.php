<?php

namespace Acomics\Ssr\Dto;

class IssuePreviewDto
{
	public int $id;
	public ?int $number;
	public ?string $name;
	public string $thumbUrl;
	public int $postDate;
	public string $serialCode;

	public function __construct(int $id, ?int $number, ?string $name, string $thumbUrl, int $postDate, string $serialCode)
	{
		$this->id = $id;
		$this->number = $number;
		$this->name = $name;
		$this->thumbUrl = $thumbUrl;
		$this->postDate = $postDate;
		$this->serialCode = $serialCode;
	}
}
