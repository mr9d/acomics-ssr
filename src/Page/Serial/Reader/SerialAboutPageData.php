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

	/** @var SerialCategoryDto[] $serialCategories */
	public array $serialCategories;

	/** @var IssuePreviewDto[] $issues */
	public array $issues;

	/**
	 * @param SerialCoauthorDto[] $coauthors
	 * @param SerialCategoryDto[] $serialCategories
	 */
	public function __construct(
		SerialDto $serial,
		?string $aboutText,
		array $serialCategories,
		array $issues)
	{
		$this->serial = $serial;
		$this->aboutText = $aboutText;
		$this->serialCategories = $serialCategories;
		$this->issues = $issues;
	}
}
