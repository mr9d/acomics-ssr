<?php

namespace Acomics\Ssr\Layout\Main;

use Acomics\Ssr\Layout\Common\CommonLayout;
use Acomics\Ssr\Util\UrlUtil;

abstract class MainLayout extends CommonLayout
{
	protected bool $isAdvertisementEnabled = false;
    protected bool $isCleanMargins = false;

	public function main(bool $isAdvertisementEnabled): void
	{
		$this->isAdvertisementEnabled = $isAdvertisementEnabled;
	}

	public function isReady(): bool
	{
        // Поля isAdvertisementEnabled и isCleanMargins не могут быть одновременно true
		return !($this->isAdvertisementEnabled && $this->isCleanMargins) && parent::isReady();
	}

    protected function head(): void
    {
        parent::head();
        echo '<link rel="stylesheet" href="' . UrlUtil::makeStaticUrlWithHash('static/bundle/main.css') . '" type="text/css" />';
        echo '<script defer src="' . UrlUtil::makeStaticUrlWithHash('static/bundle/main.js') . '"></script>';
    }

    public function top(): void
    {
		parent::top();

		echo '<main class="common-container">';

		if ($this->isAdvertisementEnabled) {
			$this->mobileTopAdvertisement();
		}

        if(!$this->isCleanMargins) {
            echo '<article class="common-article">';
        }
    }

    public function bottom(): void
    {

        if(!$this->isCleanMargins) {
            echo '</article>'; // common-article
        }

		if ($this->isAdvertisementEnabled) {
			$this->fullSidebarAdvertisement();
		}

		echo '</main>'; // common-container

		parent::bottom();
    }

	public function mobileTopAdvertisement(): void
	{
		echo '<aside class="common-aside-first">';
		$this->integrationsProvider->advertisementMobileTop();
		echo '</aside>';
	}

	public function fullSidebarAdvertisement(): void
	{
		echo '<aside class="common-aside-second">';
		$this->integrationsProvider->advertisementFullSidebar();
		echo '</aside>';
	}
}

