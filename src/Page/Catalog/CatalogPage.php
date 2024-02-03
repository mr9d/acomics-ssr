<?php

namespace Acomics\Ssr\Page\Catalog;

use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\Main\Component\CatalogFiltersForm\CatalogFiltersForm;
use Acomics\Ssr\Layout\Main\Component\CatalogSearchForm\CatalogSearchForm;
use Acomics\Ssr\Layout\Main\MainLayout;
use Acomics\Ssr\Page\PageInt;

class CatalogPage extends MainLayout implements PageInt
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

    public function content(): void
    {
        (new PageHeaderWithMenu('Комиксы'))
            ->item('/sandbox', 'Песочница', false)
            ->item('/comics', 'Каталог', true)
            ->item('/featured', 'Рекомендуемые', false)
            ->render();

        (new CatalogSearchForm())->render();

        (new CatalogFiltersForm($this->pageData->filters))->render();

    }
}
