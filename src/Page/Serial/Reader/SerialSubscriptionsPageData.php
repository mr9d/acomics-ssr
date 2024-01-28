<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\PaginatorDto;

class SerialSubscriptionsPageData
{
    public string $message;

	/** @var string[] $usernames */
    public array $usernames;

    public PaginatorDto $paginator;


	/** @param string[] $usernames */
    public function __construct(string $message, array $usernames, PaginatorDto $paginator)
    {
        $this->message = $message;
        $this->usernames = $usernames;
        $this->paginator = $paginator;
    }
}
