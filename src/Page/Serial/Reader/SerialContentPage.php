<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\Serial\Component\ContentTree\ContentTree;
use Acomics\Ssr\Layout\SerialReaderAside\SerialReaderAsideLayout;
use Acomics\Ssr\Page\PageInt;

class SerialContentPage extends SerialReaderAsideLayout implements PageInt
{
	protected ?SerialContentPageData $pageData = null;

	public function pageData(SerialContentPageData $pageData): void
	{
		$this->pageData = $pageData;
	}

	public function isReady(): bool
	{
		return $this->pageData !== null && parent::isReady();
	}

	public function content(): void
	{
        $this->header();

        if ($this->pageData->chaptersTabActive)
        {
            (new ContentTree(
                rootStruct: $this->pageData->chaptersTree,
                serialCode: $this->serialLayoutData->code,
            ))->render();
        }
        else
        {
            $this->previews();
        }
	}

    private function header(): void
    {
        $header = new PageHeaderWithMenu('Содержание комикса');

        if ($this->pageData->chaptersExists)
        {
            $header->item('?', 'По главам', $this->pageData->chaptersTabActive);
            $header->item('?skip=0', 'По страницам', !$this->pageData->chaptersTabActive);
        }

        $header->render();
    }

    private function previews(): void
    {
        echo '<p>Превьюшки</p>';
    }
}
