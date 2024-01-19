<?php

namespace Acomics\Ssr\Dto;

class PaginatorDto
{
    public int $total;
    public int $skip;
    public int $pageSize;

    public function __construct(int $total, int $skip, int $pageSize)
    {
        $this->total = $total;
        $this->skip = $skip;
        $this->pageSize = $pageSize;
    }
}
