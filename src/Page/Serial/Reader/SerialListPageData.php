<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\IssueDto;
use Acomics\Ssr\Dto\SerialDto;

class SerialListPageData
{
	public SerialDto $serial;

	/** @var IssueDto[] $issues */
	public array $issues;

	public bool $hasMoreIssues;

	/**
	 * @param IssueDto[] $issues
	 */
	public function __construct(SerialDto $serial, array $issues,  int $hasMoreIssues)
	{
		$this->serial = $serial;
		$this->issues = $issues;
		$this->hasMoreIssues = $hasMoreIssues;
	}
}
