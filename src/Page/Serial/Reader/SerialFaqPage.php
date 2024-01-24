<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\Serial\Component\Question\Question;
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
		(new PageHeaderWithMenu('Часто задаваемые вопросы (F.A.Q.) по комиксу'))->render();

        if(count($this->pageData->questions) === 0)
        {
            echo '<p>Автор не добавил ни одного перснажа.</p>';
        }
        else
        {
            foreach($this->pageData->questions as $question)
            {
                (new Question($question))->render();
            }
        }
    }
}
