<?php

namespace Acomics\Ssr\Layout\Main\Component\CatalogFiltersForm;

use Acomics\Ssr\Dto\CatalogFiltersDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Util\Ref\SerialAgeRatingProviderInt;
use Acomics\Ssr\Util\Ref\SerialCategoryProviderInt;

class CatalogFiltersForm extends AbstractComponent
{
    private SerialCategoryProviderInt $serialCategoryProvider;
    private SerialAgeRatingProviderInt $serialAgeRatingProvider;
    private CatalogFiltersDto $filters;
    private DescriptionBuilder $descriptionBuilder;

    public function __construct(
        SerialCategoryProviderInt $serialCategoryProvider,
        SerialAgeRatingProviderInt $serialAgeRatingProvider,
        CatalogFiltersDto $filters
    )
    {
        $this->serialCategoryProvider = $serialCategoryProvider;
        $this->serialAgeRatingProvider = $serialAgeRatingProvider;
        $this->filters = $filters;
        $this->descriptionBuilder = new DescriptionBuilder($filters);
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

        echo '<p>' . $this->descriptionBuilder->buildHtml() . '</p>';

        echo '</section>'; // form-mobile
    }

    private function renderDesktop(): void
    {
        echo '<section class="form-desktop">';



        echo '</section>'; // form-desktop
    }
}
