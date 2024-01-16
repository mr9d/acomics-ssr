<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\IssuePreviewDto;
use Acomics\Ssr\Dto\SerialChapterStructDto;

class SerialContentPageData
{
	public bool $chaptersExists;

	public bool $chaptersTabActive;

	/** @var IssuePreviewDto[] $issues */
	public ?array $issues;

	public ?SerialChapterStructDto $chaptersTree;

	public function __construct(
		bool $chaptersExists,
		bool $chaptersTabActive,
		?array $issues,
		?SerialChapterStructDto $chaptersTree,
	)
	{
		$this->chaptersExists = $chaptersExists;
		$this->chaptersTabActive = $chaptersTabActive;
		$this->issues = $issues;
		$this->chaptersTree = $chaptersTree;
	}
}
