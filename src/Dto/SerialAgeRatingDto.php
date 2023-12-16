<?php

namespace Acomics\Ssr\Dto;

class SerialAgeRatingDto
{
	public int $id;
	public string $name;
	public string $nameShort;
	public ?string $iconUrl;

	public function __construct(int $id, string $name, string $nameShort, ?string $iconUrl)
	{
		$this->id = $id;
		$this->name = $name;
		$this->nameShort = $nameShort;
		$this->iconUrl = $iconUrl;
	}
}
