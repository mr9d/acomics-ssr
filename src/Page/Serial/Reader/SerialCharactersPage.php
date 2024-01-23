<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Layout\SerialReaderAside\SerialReaderAsideLayout;
use Acomics\Ssr\Page\PageInt;

class SerialCharactersPage extends SerialReaderAsideLayout implements PageInt
{
	protected ?SerialCharactersPageData $pageData = null;

	public function pageData(SerialCharactersPageData $pageData): void
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
