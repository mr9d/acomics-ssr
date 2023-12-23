<?php

namespace Acomics\Ssr\Dto;

class UserDto
{
	public string $name;

	public ?string $avatarUrl;

	public function __construct(string $name, ?string $avatarUrl)
	{
		$this->name = $name;
		$this->avatarUrl = $avatarUrl;
	}
}
