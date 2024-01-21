<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Layout\Serial\Component\ReaderIssue\ReaderIssue;
use Acomics\Ssr\Layout\Serial\Component\ReaderIssueDescription\ReaderIssueDescription;
use Acomics\Ssr\Layout\Serial\Component\ReaderIssueTitle\ReaderIssueTitle;
use Acomics\Ssr\Layout\Serial\Component\ReaderListLoadMore\ReaderListLoadMore;
use Acomics\Ssr\Layout\Serial\Component\ReaderNavigator\ReaderNavigator;
use Acomics\Ssr\Layout\SerialReader\SerialReaderLayout;
use Acomics\Ssr\Page\PageInt;
use Acomics\Ssr\Util\StringUtil;
use Acomics\Ssr\Util\UrlUtil;

class SerialListPage extends SerialReaderLayout implements PageInt
{
	protected ?SerialListPageData $pageData = null;

	public function pageData(SerialListPageData $pageData): void
	{
		$this->pageData = $pageData;
	}

	public function isReady(): bool
	{
		return $this->pageData !== null && parent::isReady();
	}

    protected function head(): void
    {
        parent::head();
        echo '<script type="module">window.acomicsSerial.initReaderPage();</script>';
    }

	public function content(): void
	{
		echo '<main class="list-container">';

		$this->banner();

		if (count($this->pageData->issues) > 0)
		{
			(new ReaderNavigator(
				serial: $this->pageData->serial,
				issue: $this->pageData->issues[0],
				listType: true
			))->render();
		}

		foreach($this->pageData->issues as $index => $issue)
		{
			(new ReaderIssueTitle(
				serial: $this->pageData->serial,
				issue: $issue,
				withNavigation: false,
			))->render();
			(new ReaderIssue(
				serial: $this->pageData->serial,
				issue: $issue,
				withNavigation: false,
				isLazy: $index > 0,
			))->render();

			if ($issue->description)
			{
				(new ReaderIssueDescription(
					serial: $this->pageData->serial,
					issue: $issue,
					vkWidgetProvider: null,
				))->render();
			}
			if ($issue->commentCount > 0)
			{
				echo '<p class="list-comments-link">';
				echo '<a href="' . UrlUtil::makeSerialUrl($this->pageData->serial->code, $issue->number) . '#comments">';
				echo StringUtil::formatIntCaption($issue->commentCount, 'комментарий', 'комментария', 'комментариев');
				echo '</a>';
				echo '</p>'; // list-comments-link
			}
		}

		if ($this->pageData->hasMoreIssues)
		{
			(new ReaderListLoadMore(
				skip: $this->pageData->issues[count($this->pageData->issues) - 1]->number)
			)->render();
		}
		else
		{
			//echo '<p>Конец!</p>';
		}

		echo '</main>'; // list-container
	}

	public function banner(): void
	{
		$uid = count($this->pageData->issues) > 0 ? $this->pageData->issues[0]->number : 0;

		echo '<aside class="list-aside">';
		$this->integrationsProvider->advertisementInfiniteScroll($uid);
		echo '</aside>'; // list-aside
	}
}
