<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\IssuePreviewDto;
use Acomics\Ssr\Dto\PaginatorDto;
use Acomics\Ssr\Dto\SerialChapterStructDto;

class SerialContentPageData
{
    /**
     * Признак активной вкладки
     */
	public bool $chaptersTabActive;

    /**
     * Данные для вкладки по главам
     */
	public bool $chaptersExists;
	public ?SerialChapterStructDto $chaptersTree;

    /**
     * Данные для вкладки по страницам
     */
	/** @var IssuePreviewDto[] $issues */
	public ?array $issues;
    public ?PaginatorDto $issuesPaginator;

	public function __construct(
		bool $chaptersTabActive,
		bool $chaptersExists,
		?SerialChapterStructDto $chaptersTree,
		?array $issues,
        ?PaginatorDto $issuesPaginator,
	)
	{
		$this->chaptersExists = $chaptersExists;
		$this->chaptersTabActive = $chaptersTabActive;
		$this->issues = $issues;
		$this->chaptersTree = $chaptersTree;
		$this->issuesPaginator = $issuesPaginator;
	}
}
