<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Layout\Serial\Component\ReaderComments\ReaderComments;
use Acomics\Ssr\Layout\Serial\Component\ReaderIssue\ReaderIssue;
use Acomics\Ssr\Layout\Serial\Component\ReaderIssueDescription\ReaderIssueDescription;
use Acomics\Ssr\Layout\Serial\Component\ReaderSerialDescription\ReaderSerialDescription;
use Acomics\Ssr\Layout\Serial\Component\ReaderIssueTitle\ReaderIssueTitle;
use Acomics\Ssr\Layout\Serial\Component\ReaderNavigator\ReaderNavigator;
use Acomics\Ssr\Layout\SerialReader\SerialReaderLayout;
use Acomics\Ssr\Page\PageInt;

class SerialViewPage extends SerialReaderLayout implements PageInt
{
	protected ?SerialviewPageData $pageData = null;

	public function pageData(SerialviewPageData $pageData): void
	{
		$this->pageData = $pageData;
	}

	public function isReady(): bool
	{
		return $this->pageData !== null && parent::isReady();
	}


	public function content(): void
	{
		(new ReaderIssueTitle(
			serial: $this->serialLayoutData,
			issueNumber: $this->pageData->issueNumber,
			issueName: $this->pageData->issueName)
		)->render();

		(new ReaderIssue(
			serial: $this->serialLayoutData,
			issueNumber: $this->pageData->issueNumber,
			issueName: $this->pageData->issueName,
			issueImageUrl: $this->pageData->issueImageUrl,
			issueImageWidth: $this->pageData->issueImageWidth,
			issueImageHeight: $this->pageData->issueImageHeight)
		)->render();
		
		(new ReaderNavigator())->render();

		echo '<aside class="view-aside-first">';
		$this->advertisementProvider->renderMobileTop();
		echo '</aside>'; // view-aside-first

		echo '<main class="view-container">';

		echo '<article class="view-article">';
		(new ReaderIssueDescription())->render();
		(new ReaderComments())->render();
		echo '</article>';

		echo '<aside class="view-aside-second">';
		echo '<div class="inner">';

		echo '<div>';
		$this->advertisementProvider->renderSerialViewSidebar();
		echo '</div>';

		(new ReaderSerialDescription())->render();

		echo '</div>'; // inner
		echo '</aside>'; // view-aside-second

		echo '</main>'; // view-container
	}
}
