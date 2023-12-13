<?php

namespace Acomics\Ssr\Dto;

class SerialCategoryDto
{
	public string $code;
	public string $name;

	public function __construct(string $code, string $name)
	{
		$this->code = $code;
		$this->name = $name;
	}
}
