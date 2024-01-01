<?php

namespace Acomics\Ssr\Dto;

class SerialDto
{
	public string $name;

	public string $code;

	public ?string $aboutShort;

	public int $issueCount;

	public bool $isTranslation;

	public bool $isCompleted;

	public int $catalogStatus;

	public int $subscribersCount;

	public ?string $siteUrl;

	public ?string $originalAuthorName;

	public bool $isTopEnabled;

	public SerialAgeRatingDto $ageRating;

	public ?SerialLicenseDto $license;

	/** @var SerialCoauthorDto[] $coauthors */
	public array $coauthors;

	/**
	 * @param SerialCoauthorDto[] $coauthors
	 */
	public function __construct(
		string $name,
		string $code,
		?string $aboutShort,
		int $issueCount,
		bool $isTranslation,
		bool $isCompleted,
		int $catalogStatus,
		int $subscribersCount,
		?string $siteUrl,
		?string $originalAuthorName,
		bool $isTopEnabled,
		SerialAgeRatingDto $ageRating,
		SerialLicenseDto $license,
		array $coauthors)
	{
		$this->name = $name;
		$this->code = $code;
		$this->aboutShort = $aboutShort;
		$this->issueCount = $issueCount;
		$this->isTranslation = $isTranslation;
		$this->isCompleted = $isCompleted;
		$this->catalogStatus = $catalogStatus;
		$this->subscribersCount = $subscribersCount;
		$this->siteUrl = $siteUrl;
		$this->originalAuthorName = $originalAuthorName;
		$this->isTopEnabled = $isTopEnabled;;
		$this->ageRating = $ageRating;
		$this->license = $license;
		$this->coauthors = $coauthors;
	}
}
