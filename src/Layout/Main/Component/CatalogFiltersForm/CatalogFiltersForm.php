<?php

namespace Acomics\Ssr\Layout\Main\Component\CatalogFiltersForm;

use Acomics\Ssr\Dto\CatalogFiltersDto;
use Acomics\Ssr\Layout\AbstractComponent;

class CatalogFiltersForm extends AbstractComponent
{
    private CatalogFiltersDto $filters;

    public function __construct(CatalogFiltersDto $filters)
    {
        $this->filters = $filters;
    }

    public function render(): void
    {
        echo '<form class="catalog-filters-form">';
        $this->renderMobile();
        $this->renderDesktop();
        echo '</form>'; // catalog-filters-form
    }

    private function renderMobile(): void
    {
        echo '<section class="form-mobile">';



        echo '</section>'; // form-mobile
    }

    private function renderDesktop(): void
    {
        echo '<section class="form-desktop">';


        
        echo '</section>'; // form-desktop
    }
}
