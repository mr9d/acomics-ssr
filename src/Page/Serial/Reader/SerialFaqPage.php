<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Layout\SerialReaderAside\SerialReaderAsideLayout;
use Acomics\Ssr\Page\PageInt;

class SerialFaqPage extends SerialReaderAsideLayout implements PageInt
{
	protected ?SerialFaqPageData $pageData = null;

	public function pageData(SerialFaqPageData $pageData): void
	{
		$this->pageData = $pageData;
	}

	public function isReady(): bool
	{
		return $this->pageData !== null && parent::isReady();
	}

	public function content(): void
	{

    }
}
