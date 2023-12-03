<?php
namespace Acomics\Ssr\Layout\Main;

use Acomics\Ssr\Layout\Common\CommonLayout;
use Acomics\Ssr\Util\UrlUtil;

class MainLayout extends CommonLayout
{
	protected $isAdvertisementEnabled = false;

	public function main(bool $isAdvertisementEnabled): void
	{
		$this->isAdvertisementEnabled = $isAdvertisementEnabled;
	}

    protected function head(): void
    {
        parent::head();
        echo '<link rel="stylesheet" href="' . UrlUtil::makeStaticUrlWithHash('static/bundle/main.css') . '" type="text/css" />';
    }

    public function top(): void
    {
		parent::top();

		echo '<main class="main-container">';

		if ($this->isAdvertisementEnabled) {
			$this->mobileTopAdvertisement();
		}

		echo '<article class="main-article">';
    }

    public function bottom(): void
    {
		echo '</article>'; // main-article

		if ($this->isAdvertisementEnabled) {
			$this->fullSidebarAdvertisement();
		}

		echo '</main>'; // main-container
		
		parent::bottom();
    }

	public function mobileTopAdvertisement(): void
	{
		echo '<aside class="main-aside-first">';
		$this->advertisementProvider->renderMobileTop();
		echo '</aside>';
	}

	public function fullSidebarAdvertisement(): void
	{
		echo '<aside class="main-aside-second">';
		$this->advertisementProvider->renderFullSidebar();
		echo '</aside>';
	}
}

