<?php

namespace Acomics\Ssr\Dto;

use Acomics\Ssr\Dto\SerialAgeRatingDto;
use Acomics\Ssr\Dto\SerialLicenseDto;

class CatalogSerialDto
{
	public string $name;

	public string $code;

	public ?string $aboutShort;

	public int $issueCount;

	public int $subscrCount;

	public bool $isUpdatable;

    public float $weeklyUpdateRate;

	public bool $isTranslate;

	public int $catalogStatus;

	public ?string $siteUrl;

	public bool $isTopEnabled;

	public ?string $bannerUrl;

	public SerialAgeRatingDto $ageRating;

	public ?SerialLicenseDto $license;

    public function __construct(
        string $name,
        string $code,
        ?string $aboutShort,
        int $issueCount,
        int $subscrCount,
        bool $isUpdatable,
        float $weeklyUpdateRate,
        bool $isTranslate,
        int $catalogStatus,
        ?string $siteUrl,
        bool $isTopEnabled,
        ?string $bannerUrl,
        SerialAgeRatingDto $ageRating,
        ?SerialLicenseDto $license)
    {
        $this->name = $name;
        $this->code = $code;
        $this->aboutShort = $aboutShort;
        $this->issueCount = $issueCount;
        $this->subscrCount = $subscrCount;
        $this->isUpdatable = $isUpdatable;
        $this->weeklyUpdateRate = $weeklyUpdateRate;
        $this->isTranslate = $isTranslate;
        $this->catalogStatus = $catalogStatus;
        $this->siteUrl = $siteUrl;
        $this->isTopEnabled = $isTopEnabled;
        $this->bannerUrl = $bannerUrl;
        $this->ageRating = $ageRating;
        $this->license = $license;
    }

}
