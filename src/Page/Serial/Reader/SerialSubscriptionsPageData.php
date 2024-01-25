<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\PaginatorDto;

class SerialSubscriptionsPageData
{
	/** @var string[] $usernames */
    public array $usernames;

    public PaginatorDto $paginator;

	/** @param string[] $usernames */
    public function __construct(array $usernames, PaginatorDto $paginator)
    {
        $this->usernames = $usernames;
        $this->paginator = $paginator;
    }
}
