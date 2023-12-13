<?php

namespace Acomics\Ssr\Dto;

class SerialCoauthorDto
{
	public string $username;
	public ?string $role;

	public function __construct(string $username, ?string $role)
	{
		$this->username = $username;
		$this->role = $role;
	}
}
