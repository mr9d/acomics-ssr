<?php

namespace Acomics\Ssr\Dto;

class SerialCategoryDto
{
	public int $id;
	public string $code;
	public string $name;

	public function __construct(int $id, string $code, string $name)
	{
		$this->id = $id;
		$this->code = $code;
		$this->name = $name;
	}
}
