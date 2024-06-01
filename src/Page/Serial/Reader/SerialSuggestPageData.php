<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\IssuePreviewDto;

class SerialSuggestPageData
{
	/** @var IssuePreviewDto[] $issues */
	public array $issues;

	public int $ageRatingId;

	/**
	 * @param IssuePreviewDto[] $issues
	 */
	public function __construct(array $issues, int $ageRatingId)
	{
		$this->issues = $issues;
		$this->ageRatingId = $ageRatingId;
	}
}
