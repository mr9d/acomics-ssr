<?php

namespace Acomics\Ssr\Page\Catalog;

use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\Main\Component\CatalogFiltersForm\CatalogFiltersForm;
use Acomics\Ssr\Layout\Main\Component\CatalogSearchForm\CatalogSearchForm;
use Acomics\Ssr\Layout\Main\MainLayout;
use Acomics\Ssr\Page\PageInt;

class FeaturedPage extends MainLayout implements PageInt
{
	protected ?CatalogPageData $pageData = null;

	public function pageData(CatalogPageData $pageData): void
	{
		$this->pageData = $pageData;
	}

	public function isReady(): bool
	{
		return $this->pageData !== null && parent::isReady();
	}

    protected function head(): void
    {
        parent::head();
        echo '<script type="module">window.acomicsMain.makeCatalogFilters();</script>';
    }

    public function content(): void
    {
        (new PageHeaderWithMenu('Комиксы'))
            ->item('/sandbox', 'Песочница', false)
            ->item('/comics', 'Каталог', false)
            ->item('/featured', 'Рекомендуемые', true)
            ->render();

        (new CatalogSearchForm())->render();

        (new CatalogFiltersForm(
            serialCategoryProvider: $this->pageData->serialCategoryProvider,
            serialAgeRatingProvider: $this->pageData->serialAgeRatingProvider,
            filters: $this->pageData->filters
        ))->render();

        echo '<p>Содержимое рекомендаций</p>';
    }
}
