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
        echo '<p class="catalog-serials-header">';
        $this->renderTitle('Описание комикса', 'description', $this->filters->searchSort === 'serial_name');
        $this->renderTitle('Активность', 'activity', $this->filters->searchSort === 'last_update' || $this->filters->searchSort === 'issue_count');
        $this->renderTitle('Подписчики', 'subscribe', $this->filters->searchSort === 'subscr_count');
        echo '</p>'; // catalog-serials-header
    }

    private function renderTitle(string $title, string $cssClass, bool $isSorting): void
    {
        echo '<span class="' . ($isSorting ? 'sorting ' : '') . $cssClass . '">';
        echo $title;
        echo '</span>';
    }
}

