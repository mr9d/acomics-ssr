<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\IssuePreviewDto;
use Acomics\Ssr\Dto\SerialCategoryDto;
use Acomics\Ssr\Dto\SerialCoauthorDto;
use Acomics\Ssr\Dto\SerialDto;

class SerialAboutPageData
{
	public SerialDto $serial;

	public ?string $aboutText;

	/** @var SerialCoauthorDto[] $coauthors */
	public array $coauthors;

	/** @var SerialCategoryDto[] $categories */
	public array $categories;

	/** @var IssuePreviewDto[] $issues */
	public array $issues;

	/**
	 * @param SerialCoauthorDto[] $coauthors
	 * @param SerialCategoryDto[] $categories
	 * @param IssuePreviewDto[] $issues
	 */
	public function __construct(
		SerialDto $serial,
		?string $aboutText,
		array $coauthors,
		array $categories,
		array $issues)
	{
		$this->serial = $serial;
		$this->aboutText = $aboutText;
		$this->coauthors = $coauthors;
		$this->categories = $categories;
		$this->issues = $issues;
	}
}
