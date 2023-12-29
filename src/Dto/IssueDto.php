<?php

namespace Acomics\Ssr\Dto;

class IssueDto
{
	public int $id;

	public int $number;

	public ?string $name;

	public string $url;

	public int $width;

	public int $height;

	public ?string $alternativeText;

	public ?string $description;

	public int $postDate;

	public int $commentCount;

	public ?string $originalUrl;

	public UserDto $user;

	public bool $isEditable;

	public function __construct(
		int $id,
		int $number,
		?string $name,
		string $url,
		int $width,
		int $height,
		?string $alternativeText,
		?string $description,
		int $postDate,
		int $commentCount,
		?string $originalUrl,
		UserDto $user,
		bool $isEditable)
	{
		$this->id = $id;
		$this->number = $number;
		$this->name = $name;
		$this->url = $url;
		$this->width = $width;
		$this->height = $height;
		$this->alternativeText = $alternativeText;
		$this->description = $description;
		$this->postDate = $postDate;
		$this->commentCount = $commentCount;
		$this->originalUrl = $originalUrl;
		$this->user = $user;
		$this->isEditable = $isEditable;
	}
}
