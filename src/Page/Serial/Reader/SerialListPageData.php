<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\ReaderIssueDto;
use Acomics\Ssr\Dto\ReaderSerialDto;

class SerialListPageData
{
	public ReaderSerialDto $serial;

	/** @var ReaderIssueDto[] $issues */
	public array $issues;

	public bool $hasMoreIssues;

	/**
	 * @param ReaderIssueDto[] $issues
	 */
	public function __construct(ReaderSerialDto $serial, array $issues,  int $hasMoreIssues)
	{
		$this->serial = $serial;
		$this->issues = $issues;
		$this->hasMoreIssues = $hasMoreIssues;
	}
}
