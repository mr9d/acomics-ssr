<?php

namespace Acomics\Ssr\Page\Catalog;

class SearchResultPageData
{
    public ?string $query;

    public function __construct(?string $query)
    {
        $this->query = $query;
    }
}
