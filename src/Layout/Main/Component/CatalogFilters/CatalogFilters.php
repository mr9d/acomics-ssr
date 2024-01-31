<?php

namespace Acomics\Ssr\Layout\Main\Component\CatalogFilters;

use Acomics\Ssr\Layout\AbstractComponent;

class CatalogFilters extends AbstractComponent
{
    public function __construct()
    {

    }

    public function render(): void
    {
        echo '<p>Фильтры каталога</p>';
    }
}
