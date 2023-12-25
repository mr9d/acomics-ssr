<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderIssueDescription;

use Acomics\Ssr\Dto\IssueDto;
use Acomics\Ssr\Dto\SerialDto;
use Acomics\Ssr\Layout\AbstractComponent;

class ReaderIssueDescription extends AbstractComponent
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
		echo '<section class="reader-issue-description">';
		echo 'issue description';
		echo '</section>';
	}
}
