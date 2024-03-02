<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderIssueTitle;

use Acomics\Ssr\Dto\ReaderIssueDto;
use Acomics\Ssr\Dto\ReaderSerialDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Util\UrlUtil;

class ReaderIssueTitle extends AbstractComponent
{
	private ReaderSerialDto $serial;
	private ReaderIssueDto $issue;
	private bool $withNavigation;

	public function __construct(ReaderSerialDto $serial, ReaderIssueDto $issue, bool $withNavigation = true)
	{
		$this->serial = $serial;
		$this->issue = $issue;
		$this->withNavigation = $withNavigation;
	}

	public function render(): void
	{
		if ($this->withNavigation)
		{
			$this->renderWithNavigation();
		}
		else
		{
			$this->renderWithoutNavigation();
		}
	}

	public function renderWithNavigation(): void
	{
		echo '<h1 class="reader-issue-title" id="title">';

		if($this->issue->number > 1)
		{
			echo '<a href="' . UrlUtil::makeSerialUrl($this->serial->code, $this->issue->number - 1) . '#title" aria-label="Предыдущий выпуск">&larr;</a>';
		}

		$this->renderNumber();

		if($this->issue->number < $this->serial->issueCount)
		{
			echo '<a href="' . UrlUtil::makeSerialUrl($this->serial->code, $this->issue->number + 1) . '#title" aria-label="Следующий выпуск">&rarr;</a>';
		}

		echo '</h1>'; // reader-issue-title
	}

	public function renderWithoutNavigation(): void
	{
		echo '<h2 class="reader-issue-title">';

		$this->renderNumber();

		echo '</h2>'; // reader-issue-title
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

