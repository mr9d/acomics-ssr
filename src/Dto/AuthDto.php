<?php

namespace Acomics\Ssr\Dto;

class AuthDto
{
	public bool $isLoggedIn;
	public ?string $username;
	public string $avatarUrl;
	public int $messagesCount;
	public array $extraUserMenuLinks;
}
