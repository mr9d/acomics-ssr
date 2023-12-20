<?php

namespace Acomics\Ssr\Layout\Common;

use Acomics\Ssr\Dto\LinkDto;

class AuthData
{
	public bool $isLoggedIn;

	public ?string $username;

	public string $avatarUrl;

	public int $messagesCount;

	/** @var LinkDto[] */
	public array $extraUserMenuLinks;

	/** @param LinkDto[] $extraUserMenuLinks */
	public function __construct(bool $isLoggedIn, ?string $username, string $avatarUrl, int $messagesCount, array $extraUserMenuLinks)
	{
		$this->isLoggedIn = $isLoggedIn;
		$this->username = $username;
		$this->avatarUrl = $avatarUrl;
		$this->messagesCount = $messagesCount;
		$this->extraUserMenuLinks = $extraUserMenuLinks;
	}
}
