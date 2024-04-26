<?php

namespace Acomics\Ssr\Page\Main;

use Acomics\Ssr\Layout\Main\Component\MainCover\MainCover;
use Acomics\Ssr\Layout\Main\Component\MainFeatured\MainFeatured;
use Acomics\Ssr\Layout\Main\Component\MainPublishHowto\MainPublishHowto;
use Acomics\Ssr\Layout\Main\Component\MainSpotlight\MainSpotlight;
use Acomics\Ssr\Layout\Main\MainLayout;
use Acomics\Ssr\Page\PageInt;

class MainPage extends MainLayout implements PageInt
{
	protected ?MainPageData $pageData = null;

	public function pageData(MainPageData $pageData): void
	{
		$this->pageData = $pageData;
	}

	public function isReady(): bool
	{
		return $this->pageData !== null && parent::isReady();
	}

	public function __construct()
	{
		$this->title('Авторский Комикс: публикация комиксов на русском, читать комиксы онлайн бесплатно');
	}

	public function top(): void
	{
		parent::top();
		$this->integrationsProvider->vkInit(group: true);
	}

    public function content(): void
    {
        (new MainFeatured())->render();
        (new MainCover())->render();
        (new MainPublishHowto())->render();
        $this->integrationsProvider->vkGroup();
        (new MainSpotlight())->render();
    }
}
