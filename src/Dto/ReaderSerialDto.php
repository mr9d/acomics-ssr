<?php

namespace Acomics\Ssr\Dto;

class ReaderSerialDto
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

	public int $ageRatingId;

	public int $licenseId;

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
		int $ageRatingId,
		int $licenseId)
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
		$this->ageRatingId = $ageRatingId;
		$this->licenseId = $licenseId;
	}
}
