<?php

namespace Acomics\Ssr\Layout\Main\Component\CatalogSearchForm;

use Acomics\Ssr\Layout\AbstractComponent;

class CatalogSearchForm extends AbstractComponent
{
    private ?string $query;

    public function __construct(?string $query = null)
    {
        $this->query = $query;
    }

    public function render(): void
    {
        echo '<p>Форма поиска по каталогу</p>';
    }
}
