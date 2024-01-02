<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderIssueTitle;

use Acomics\Ssr\Dto\IssueDto;
use Acomics\Ssr\Dto\SerialDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Util\UrlUtil;

class ReaderIssueTitle extends AbstractComponent
{
	private SerialDto $serial;
	private IssueDto $issue;

	public function __construct(SerialDto $serial, IssueDto $issue)
	{
		$this->serial = $serial;
		$this->issue = $issue;
	}

	public function render(): void
	{
		echo '<h1 class="reader-issue-title">';

		if($this->issue->number > 1)
		{
			echo '<a href="' . UrlUtil::makeSerialUrl($this->serial->code, $this->issue->number - 1) . '" aria-label="Предыдущий выпуск">&larr;</a>';
		}

		$this->renderNumber();

		if($this->issue->number < $this->serial->issueCount)
		{
			echo '<a href="' . UrlUtil::makeSerialUrl($this->serial->code, $this->issue->number + 1) . '" aria-label="Следующий выпуск">&rarr;</a>';
		}

		echo '</h1>'; // reader-issue-title
	}

	private function renderNumber(): void
	{
		if ($this->issue->name)
		{
			echo '<span class="number-with-name">';
			echo $this->issue->name;
			echo '<span class="number">' . $this->issue->number . '/' . $this->serial->issueCount . '</span>';
			echo '</span>'; // number-with-name
		}
		else
		{
			echo '<span class="number-without-name">';
			echo $this->issue->number . '/' . $this->serial->issueCount;
			echo '</span>'; // number-without-name
		}
	}
}

