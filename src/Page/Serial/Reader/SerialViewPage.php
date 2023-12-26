<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Layout\Serial\Component\ReaderComment\ReaderComment;
use Acomics\Ssr\Layout\Serial\Component\ReaderCommentForm\ReaderCommentForm;
use Acomics\Ssr\Layout\Serial\Component\ReaderIssue\ReaderIssue;
use Acomics\Ssr\Layout\Serial\Component\ReaderIssueDescription\ReaderIssueDescription;
use Acomics\Ssr\Layout\Serial\Component\ReaderSerialDescription\ReaderSerialDescription;
use Acomics\Ssr\Layout\Serial\Component\ReaderIssueTitle\ReaderIssueTitle;
use Acomics\Ssr\Layout\Serial\Component\ReaderNavigator\ReaderNavigator;
use Acomics\Ssr\Layout\SerialReader\SerialReaderLayout;
use Acomics\Ssr\Page\PageInt;

class SerialViewPage extends SerialReaderLayout implements PageInt
{
	protected ?SerialViewPageData $pageData = null;

	public function pageData(SerialViewPageData $pageData): void
	{
		$this->pageData = $pageData;
	}

	public function isReady(): bool
	{
		return $this->pageData !== null && parent::isReady();
	}


	public function content(): void
	{
		$this->topSection();

		echo '<aside class="view-aside-first">';
		$this->advertisementProvider->renderMobileTop();
		echo '</aside>'; // view-aside-first

		echo '<main class="view-container">';

		echo '<article class="view-article">';
		$this->bottomLeftSection();
		echo '</article>'; // view-article

		echo '<aside class="view-aside-second">';
		$this->bottomRightSection();
		echo '</aside>'; // view-aside-second

		echo '</main>'; // view-container
	}

	private function topSection(): void
	{
		(new ReaderIssueTitle(
			serial: $this->pageData->serial,
			issue: $this->pageData->issue)
		)->render();

		(new ReaderIssue(
			serial: $this->pageData->serial,
			issue: $this->pageData->issue)
		)->render();

		(new ReaderNavigator(
			serial: $this->pageData->serial,
			issue: $this->pageData->issue)
		)->render();
	}

	private function bottomLeftSection(): void
	{
		(new ReaderIssueDescription(
			serial: $this->pageData->serial,
			issue: $this->pageData->issue)
		)->render();

		foreach($this->pageData->comments as $comment)
		{
			(new ReaderComment($comment))->render();
		}

		if($this->pageData->commentsAllowed)
		{
			(new ReaderCommentForm($this->pageData->serial))->render();
		}
		else
		{
			echo '<div class="view-comments-disallowed">';
			echo $this->pageData->commentsDisallowMessage;
			echo '</div>';
		}
	}

	private function bottomRightSection(): void
	{
		echo '<div class="inner">';

		$this->advertisementProvider->renderSerialViewSidebar();

		(new ReaderSerialDescription(
			serial: $this->pageData->serial)
		)->render();

		echo '</div>'; // inner
	}
}
