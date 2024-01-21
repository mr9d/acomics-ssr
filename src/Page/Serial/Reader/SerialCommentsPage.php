<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Layout\Common\Component\Paginator\Paginator;
use Acomics\Ssr\Layout\Serial\Component\ReaderComment\ReaderComment;
use Acomics\Ssr\Layout\SerialReaderAside\SerialReaderAsideLayout;
use Acomics\Ssr\Page\PageInt;

class SerialCommentsPage extends SerialReaderAsideLayout implements PageInt
{
	protected ?SerialCommentsPageData $pageData = null;

	public function pageData(SerialCommentsPageData $pageData): void
	{
		$this->pageData = $pageData;
	}

	public function isReady(): bool
	{
		return $this->pageData !== null && parent::isReady();
	}

    public function content(): void
    {
        if(count($this->pageData->comments) === 0)
        {
            $this->empty();
            return;
        }

        $paginator = new Paginator($this->pageData->paginator, 'списка комментариев');

        $paginator->render();

        echo '<section class="serial-comments-list">';

        foreach($this->pageData->comments as $comment)
		{
			(new ReaderComment(
                comment: $comment,
                linkType: ReaderComment::LINK_TYPE_ISSUE
            ))->render();
		}

        echo '</section>'; // serial-comments-list

        $paginator->render();
    }

    public function empty(): void
    {
        echo '<p>Нет ни одного комментария</p>';
    }
}
