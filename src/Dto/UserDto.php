<?php

namespace Acomics\Ssr\Dto;

class UserDto
{
	public string $name;

	public ?string $avatarUrl;

	public bool $isAnonymous;

	public function __construct(string $name, ?string $avatarUrl, bool $isAnonymous = false)
	{
		$this->name = $name;
		$this->avatarUrl = $avatarUrl;
		$this->isAnonymous = $isAnonymous;
	}
}
