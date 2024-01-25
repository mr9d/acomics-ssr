<?php

namespace Acomics\Ssr\Dto;

class SerialAgeRatingDto
{
	public int $id;
	public string $name;
	public string $nameShort;
	public ?string $iconUrl;
	public ?int $ageRestrict;

	public function __construct(int $id, string $name, string $nameShort, ?string $iconUrl, ?int $ageRestrict)
	{
		$this->id = $id;
		$this->name = $name;
		$this->nameShort = $nameShort;
		$this->iconUrl = $iconUrl;
        $this->ageRestrict = $ageRestrict;
	}
}
