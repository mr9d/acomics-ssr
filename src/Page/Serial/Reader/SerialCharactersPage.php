<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\Serial\Component\Character\Character;
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
		(new PageHeaderWithMenu('Персонажи комикса'))->render();

        if(count($this->pageData->characters) === 0)
        {
            echo '<p>Автор не добавил ни одного перснажа.</p>';
        }
        else
        {
            foreach($this->pageData->characters as $character)
            {
                (new Character($character))->render();
            }
        }
    }
}
