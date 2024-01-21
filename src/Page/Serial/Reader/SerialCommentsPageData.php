<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\CommentDto;
use Acomics\Ssr\Dto\PaginatorDto;

class SerialCommentsPageData
{
	/** @param CommentDto[] */
	public array $comments;

    public PaginatorDto $paginator;

    public function __construct(array $comments, PaginatorDto $paginator)
    {
        $this->comments = $comments;
        $this->paginator = $paginator;
    }
}
