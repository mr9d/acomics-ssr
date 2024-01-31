<?php

namespace Acomics\Ssr\Page\Catalog;

use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\Main\Component\CatalogSearchForm\CatalogSearchForm;
use Acomics\Ssr\Layout\Main\MainLayout;
use Acomics\Ssr\Page\PageInt;

class SearchResultPage extends MainLayout implements PageInt
{
	protected ?SearchResultPageData $pageData = null;

	public function pageData(SearchResultPageData $pageData): void
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
            ->item('/comics', 'Каталог', false)
            ->item('/featured', 'Рекомендуемые', false)
            ->render();

        (new CatalogSearchForm())->render();
    }
}
