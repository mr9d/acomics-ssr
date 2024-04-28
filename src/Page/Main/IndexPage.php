<?php

namespace Acomics\Ssr\Page\Main;

use Acomics\Ssr\Layout\Main\Component\IndexCover\IndexCover;
use Acomics\Ssr\Layout\Main\Component\IndexFeatured\IndexFeatured;
use Acomics\Ssr\Layout\Main\Component\IndexPublishHowto\IndexPublishHowto;
use Acomics\Ssr\Layout\Main\Component\IndexSpotlight\IndexSpotlight;
use Acomics\Ssr\Layout\Main\MainLayout;
use Acomics\Ssr\Page\PageInt;

class IndexPage extends MainLayout implements PageInt
{
	protected ?IndexPageData $pageData = null;

	public function pageData(IndexPageData $pageData): void
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
        IndexCover::headDeps();
        echo '<script type="module">window.acomicsMain.initIndexPage();</script>';
        echo $this->pageData->magicHeadElements;
    }

	public function __construct()
	{
        $this->isCleanMargins = true;
	}

	public function top(): void
	{
		parent::top();
		$this->integrationsProvider->vkInit(group: true);
	}

    public function content(): void
    {
        echo '<div class="index-page">';

        (new IndexFeatured())->render();
        (new IndexCover($this->pageData->covers))->render();
        (new IndexPublishHowto())->render();
        (new IndexSpotlight())->render();
        $this->vkGroup();

        echo '</div>'; // index-page
    }

    private function vkGroup(): void
    {
        echo '<div class="index-vk-group">';
        $this->integrationsProvider->vkGroup();
        echo '</div>'; // index-vk-group
    }
}
