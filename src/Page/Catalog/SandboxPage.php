<?php

namespace Acomics\Ssr\Page\Catalog;

use Acomics\Ssr\Layout\Common\Component\InfiniteScroll\InfiniteScroll;
use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\Common\Component\SerialCard\SerialCard;
use Acomics\Ssr\Layout\Main\Component\CatalogFiltersForm\CatalogFiltersForm;
use Acomics\Ssr\Layout\Main\Component\CatalogSearchForm\CatalogSearchForm;
use Acomics\Ssr\Layout\Main\Component\CatalogSerialsHeader\CatalogSerialsHeader;
use Acomics\Ssr\Layout\Main\MainLayout;
use Acomics\Ssr\Page\PageInt;
use Acomics\Ssr\Util\UrlUtil;

class SandboxPage extends MainLayout implements PageInt
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
        echo '<script type="module">window.acomicsMain.initCatalogPage();</script>';
    }

    public function content(): void
    {
        (new PageHeaderWithMenu('Комиксы'))
            ->item('/sandbox', 'Песочница', true)
            ->item('/comics', 'Каталог', false)
            ->item('/featured', 'Рекомендуемые', false)
            ->render();

        (new CatalogSearchForm())->render();

        (new CatalogFiltersForm(
            filters: $this->pageData->filters
        ))->render();

        $this->serials();
    }

    public function serials(): void
    {
        if (count($this->pageData->serials) === 0)
        {
            echo '<p>Нет подходящих комиксов</p>'; //tbd
        }
        else
        {
            (new CatalogSerialsHeader(
                filters: $this->pageData->filters
            ))->render();

            echo '<div class="' . InfiniteScroll::CONTENT_CLASS . '">';

            foreach($this->pageData->serials as $index => $serial)
            {
                (new SerialCard(
                    serial: $serial
                ))->render();

                if ($index === 1)
                {
                    $this->integrationsProvider->advertisementInfiniteScroll($this->pageData->skip);
                }
            }

            if ($this->pageData->hasMoreSerials)
            {
                (new InfiniteScroll(
                    url: UrlUtil::updatePageUrlParameter('skip', $this->pageData->skip + count($this->pageData->serials)),
                    maxLoads: 50,
                ))->render();
            }

            echo '</div>'; // InfiniteScroll::CONTENT_CLASS
        }
    }
}
