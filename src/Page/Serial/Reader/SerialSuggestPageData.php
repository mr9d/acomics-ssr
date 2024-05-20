<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\IssuePreviewDto;
use Acomics\Ssr\Dto\SerialAgeRatingDto;

class SerialSuggestPageData
{
	/** @var IssuePreviewDto[] $issues */
	public array $issues;

	public SerialAgeRatingDto $ageRating;

	/**
	 * @param IssuePreviewDto[] $issues
	 */
	public function __construct(array $issues, SerialAgeRatingDto $ageRating)
	{
		$this->issues = $issues;
		$this->ageRating = $ageRating;
	}
}
