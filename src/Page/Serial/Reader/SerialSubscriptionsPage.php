<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\SerialReaderAside\SerialReaderAsideLayout;
use Acomics\Ssr\Page\PageInt;

class SerialSubscriptionsPage extends SerialReaderAsideLayout implements PageInt
{
	protected ?SerialSubscriptionsPageData $pageData = null;

	public function pageData(SerialSubscriptionsPageData $pageData): void
	{
		$this->pageData = $pageData;
	}

	public function isReady(): bool
	{
		return $this->pageData !== null && parent::isReady();
	}

    public function content(): void
    {
		(new PageHeaderWithMenu('Подписчики'))->render();

        
    }
}
