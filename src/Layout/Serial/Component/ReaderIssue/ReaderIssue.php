<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderIssue;

use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Serial\SerialLayoutData;

class ReaderIssue extends AbstractComponent
{
	private SerialLayoutData $serial;

	private int $issueNumber;

	private ?string $issueName;

	private string $issueImageUrl;

	private int $issueImageWidth;

	private int $issueImageHeight;

	public function __construct(
		SerialLayoutData $serial,
		int $issueNumber,
		?string $issueName,
		string $issueImageUrl,
		int $issueImageWidth,
		int $issueImageHeight)
	{
		$this->serial = $serial;
		$this->issueNumber = $issueNumber;
		$this->issueName = $issueName;
		$this->issueImageUrl = $issueImageUrl;
		$this->issueImageWidth = $issueImageWidth;
		$this->issueImageHeight = $issueImageHeight;
	}

	public function render(): void
	{
		echo '<main class="reader-issue">';

		$this->renderImage();

		echo '</main>'; // reader-issue
	}

	private function renderImage(): void
	{
		$imgStyle = 'height: calc(100% * ' . $this->issueImageHeight .' / ' . $this->issueImageWidth .'); max-width: ' . $this->issueImageWidth . 'px';
		echo '<img class="issue" src="' . $this->issueImageUrl . '" width="' . $this->issueImageWidth . '" height="' . $this->issueImageHeight . '" style="' . $imgStyle . '" />';
	}
}
