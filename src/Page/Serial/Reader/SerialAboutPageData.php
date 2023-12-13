<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\SerialAgeRatingDto;
use Acomics\Ssr\Dto\SerialCategoryDto;
use Acomics\Ssr\Dto\SerialCoauthorDto;
use Acomics\Ssr\Dto\SerialLicenseDto;

class SerialAboutPageData
{
	public bool $isTranslation;

	public bool $isCompleted;

	public int $catalogStatus;

	public int $subscribersCount;

	public ?string $aboutText;

	public ?string $siteUrl;

	public ?string $originalAuthorName;

	public SerialAgeRatingDto $ageRating;

	public ?SerialLicenseDto $license;

	/** @var SerialCoauthorDto[] $coauthors */
	public array $coauthors;

	/** @var SerialCategoryDto[] $serialCategories */
	public array $serialCategories;


	/**
	 * @param SerialCoauthorDto[] $coauthors
	 * @param SerialCategoryDto[] $serialCategories
	 */
	public function __construct(
		bool $isTranslation,
		bool $isCompleted,
		int $catalogStatus,
		int $subscribersCount,
		?string $aboutText,
		?string $siteUrl,
		?string $originalAuthorName,
		SerialAgeRatingDto $ageRating,
		SerialLicenseDto $license,
		array $coauthors,
		array $serialCategories)
	{
		$this->isTranslation = $isTranslation;
		$this->isCompleted = $isCompleted;
		$this->catalogStatus = $catalogStatus;
		$this->subscribersCount = $subscribersCount;
		$this->aboutText = $aboutText;
		$this->siteUrl = $siteUrl;
		$this->originalAuthorName = $originalAuthorName;
		$this->ageRating = $ageRating;
		$this->license = $license;
		$this->coauthors = $coauthors;
		$this->serialCategories = $serialCategories;
	}
}
