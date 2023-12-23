<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\IssueDto;
use Acomics\Ssr\Dto\SerialDto;

class SerialViewPageData
{
	public SerialDto $serial;
	public IssueDto $issue;

	public function __construct(
		SerialDto $serial,
		IssueDto $issue)
	{
		$this->serial = $serial;
		$this->issue = $issue;
	}
}
