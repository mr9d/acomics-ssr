<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderIssue;

use Acomics\Ssr\Dto\IssueDto;
use Acomics\Ssr\Dto\SerialDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Util\UrlUtil;

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

		if ($this->issue->number < $this->serial->issueCount)
		{
			$this->renderNext();
		}
		else
		{
			$this->renderImage();
		}

		if ($this->issue->number > 1)
		{
			$this->renderPrevious();
		}

		echo '</main>'; // reader-issue
	}

	private function renderImage(): void
	{
		$style = 'height: calc(100% * ' . $this->issue->height .' / ' . $this->issue->width .'); max-width: ' . $this->issue->width . 'px';
		$alt = $this->issue->name ? $this->issue->name : 'Комикс ' . $this->serial->name . ': выпуск №' . $this->issue->number;

		echo '<img
			class="issue"
			src="' . $this->issue->url . '"
			width="' . $this->issue->width . '"
			height="' . $this->issue->height . '"
			style="' . $style . '"
			alt="' . $alt . '"' . ($this->issue->alternativeText ? ' title="' . $this->issue->alternativeText . '"' : '') . '
			/>';
	}

	private function renderNext(): void
	{
		echo '<a href="' . UrlUtil::makeSerialUrl($this->serial->code, $this->issue->number + 1) . '" class="reader-issue-next">';
		$this->renderImage();
		echo '<div class="arrow"></div>';
		echo '</a>';
	}

	private function renderPrevious(): void
	{
		echo '<a href="' . UrlUtil::makeSerialUrl($this->serial->code, $this->issue->number - 1) . '" class="reader-issue-previous">';
		echo '<div class="arrow"></div>';
		echo '</a>';
	}
}
