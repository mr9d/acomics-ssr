<?php

namespace Acomics\Ssr\Layout\Serial\Component\IssuePreview;

use Acomics\Ssr\Dto\IssuePreviewDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Util\UrlUtil;

class IssuePreview extends AbstractComponent
{
	private IssuePreviewDto $issue;

	public function __construct(IssuePreviewDto $issue)
	{
		$this->issue = $issue;
	}

	public function render(): void
	{
		$seriaUrl = UrlUtil::makeSerialUrl($this->issue->serialCode, $this->issue->number);

		echo '<a href="' . $seriaUrl . '" class="issue-preview">';

		echo '<img src="' . $this->issue->thumbUrl . '" />';

		echo '</a>'; // issue-preview
	}
}
