<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderIssueTitle;

use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Serial\SerialLayoutData;
use Acomics\Ssr\Util\UrlUtil;

class ReaderIssueTitle extends AbstractComponent
{
	private SerialLayoutData $serial;

	private int $issueNumber;

	private ?string $issueName;

	public function __construct(SerialLayoutData $serial, int $issueNumber, ?string $issueName)
	{
		$this->serial = $serial;
		$this->issueNumber = $issueNumber;
		$this->issueName = $issueName;
	}

	public function render(): void
	{
		echo '<h1 class="reader-issue-title">';

		if($this->issueNumber > 1)
		{
			echo '<a href="' . UrlUtil::makeSerialUrl($this->serial->code, $this->issueNumber - 1) . '">&larr;</a>';
		}

		$this->renderNumber();

		if($this->issueNumber < $this->serial->issueCount)
		{
			echo '<a href="' . UrlUtil::makeSerialUrl($this->serial->code, $this->issueNumber + 1) . '"> &nbsp;&rarr;</a>';
		}

		echo '</h1>'; // reader-issue-title
	}

	private function renderNumber(): void
	{
		if ($this->issueName)
		{
			echo '<span class="number-with-name">';
			echo $this->issueName;
			echo '<span class="number">' . $this->issueNumber . '/' . $this->serial->issueCount . '</span>';
			echo '</span>'; // number-with-name
		}
		else
		{
			echo '<span class="number-without-name">';
			echo $this->issueNumber . '/' . $this->serial->issueCount;
			echo '</span>'; // number-without-name
		}
	}
}

