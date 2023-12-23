<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderIssue;

use Acomics\Ssr\Dto\IssueDto;
use Acomics\Ssr\Dto\SerialDto;
use Acomics\Ssr\Layout\AbstractComponent;

class ReaderIssue extends AbstractComponent
{
	private SerialDto $serial;

	private IssueDto $issue;

	public function __construct(
		SerialDto $serial,
		IssueDto $issue)
	{
		$this->serial = $serial;
		$this->issue = $issue;
	}

	public function render(): void
	{
		echo '<main class="reader-issue">';

		$this->renderImage();

		echo '</main>'; // reader-issue
	}

	private function renderImage(): void
	{
		$imgStyle = 'height: calc(100% * ' . $this->issue->height .' / ' . $this->issue->width .'); max-width: ' . $this->issue->width . 'px';
		echo '<img class="issue" src="' . $this->issue->url . '" width="' . $this->issue->width . '" height="' . $this->issue->height . '" style="' . $imgStyle . '" />';
	}
}
