<?php

namespace Acomics\Ssr\Dto;

class SerialLicenseDto
{
	public string $name;
	public string $nameShort;
	public ?string $iconUrl;
	public ?string $descriptionUrl;

	public function __construct(string $name, string $nameShort, ?string $iconUrl, ?string $descriptionUrl)
	{
		$this->name = $name;
		$this->nameShort = $nameShort;
		$this->iconUrl = $iconUrl;
		$this->descriptionUrl = $descriptionUrl;
	}
}
