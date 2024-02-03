<?php

namespace Acomics\Ssr\Page\Catalog;

use Acomics\Ssr\Dto\CatalogFiltersDto;

class CatalogPageData
{
    public CatalogFiltersDto $filters;

    public function __construct(CatalogFiltersDto $filters)
    {
        $this->filters = $filters;
    }
}
