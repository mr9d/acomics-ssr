<?php

namespace Acomics\Ssr\Layout\Main\Component\CatalogSerialsHeader;

use Acomics\Ssr\Dto\CatalogFiltersDto;
use Acomics\Ssr\Layout\AbstractComponent;

class CatalogSerialsHeader extends AbstractComponent
{
    private ?CatalogFiltersDto $filters;

    public function __construct(
        ?CatalogFiltersDto $filters
    )
    {
        $this->filters = $filters;
    }

    public function render(): void
    {
        echo '<p>CatalogSerialsHeader</p>';
    }

}

