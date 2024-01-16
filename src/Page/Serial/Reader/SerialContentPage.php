<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\SerialChapterStructDto;
use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\SerialReaderAside\SerialReaderAsideLayout;
use Acomics\Ssr\Page\PageInt;
use Acomics\Ssr\Util\UrlUtil;

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
            $this->chapterStruct($this->pageData->chaptersTree);
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

    private function chapterStruct(SerialChapterStructDto $chapterStruct): void
    {
        if($chapterStruct->headerLevel !== 0)
        {
            echo '<p>' . $chapterStruct->name . ' (Уровень: ' . $chapterStruct->headerLevel . ')</p>';
        }
        echo '<section>';

        if($chapterStruct->chapters !== null)
        {
            foreach($chapterStruct->chapters as $chapter)
            {
                echo '<p><a href="' . UrlUtil::makeSerialUrl($this->serialLayoutData->code, $chapter->issueNumber) . '">' . $chapter->name . '</a></p>';
            }
        }

        if($chapterStruct->childStructs !== null)
        {
            foreach($chapterStruct->childStructs as $struct)
            {
                $this->chapterStruct($struct);
            }
        }

        echo '</section>';
    }

    private function previews(): void
    {
        echo '<p>Превьюшки</p>';
    }
}
