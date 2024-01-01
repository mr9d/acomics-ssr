<?php

namespace Acomics\Ssr\Layout\SerialReaderAside;

use Acomics\Ssr\Layout\Serial\Component\ReaderMenu\ReaderMenu;
use Acomics\Ssr\Layout\Serial\SerialLayout;

abstract class SerialReaderAsideLayout extends SerialLayout
{
    protected function head(): void
    {
        parent::head();
    }

    public function top(): void
    {
		parent::top();
		(new ReaderMenu($this->serialLayoutData))->render();

		echo '<main class="common-container">';

		$this->mobileTopAdvertisement();

		echo '<article class="common-article">';
    }

    public function bottom(): void
    {
		echo '</article>'; // common-article

		$this->fullSidebarAdvertisement();

		echo '</main>'; // common-container

		parent::bottom();
    }

	public function mobileTopAdvertisement(): void
	{
		echo '<aside class="common-aside-first serial-aside-first">';
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
