<?php

namespace Acomics\Ssr\Dto;

use Acomics\Ssr\Dto\SerialAgeRatingDto;
use Acomics\Ssr\Dto\SerialLicenseDto;

class CatalogSerialDto
{
    //
    // Основное
    //
	public int $id;

	public string $name;

	public string $code;

	public ?string $aboutShort;

	public int $issueCount;

    //
    // Подписки
    //
	public bool $isSubscribed;

	public int $subscrCount;

    //
    // Обновления
    //
	public bool $isUpdatable;

    public float $weeklyUpdateRate;

	public int $lastUpdate;

    //
    // Остальные настройки
    //
	public bool $isTranslate;

	public int $catalogStatus;

	public ?string $siteUrl;

	public bool $isTopEnabled;

	public ?string $bannerUrl;

	public SerialAgeRatingDto $ageRating;

	public ?SerialLicenseDto $license;

    public function __construct(
        int $id,
        string $name,
        string $code,
        ?string $aboutShort,
        int $issueCount,
        bool $isSubscribed,
        int $subscrCount,
        bool $isUpdatable,
        float $weeklyUpdateRate,
	    int $lastUpdate,
        bool $isTranslate,
        int $catalogStatus,
        ?string $siteUrl,
        bool $isTopEnabled,
        ?string $bannerUrl,
        SerialAgeRatingDto $ageRating,
        ?SerialLicenseDto $license)
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->aboutShort = $aboutShort;
        $this->issueCount = $issueCount;
        $this->isSubscribed = $isSubscribed;
        $this->subscrCount = $subscrCount;
        $this->isUpdatable = $isUpdatable;
        $this->weeklyUpdateRate = $weeklyUpdateRate;
        $this->lastUpdate = $lastUpdate;
        $this->isTranslate = $isTranslate;
        $this->catalogStatus = $catalogStatus;
        $this->siteUrl = $siteUrl;
        $this->isTopEnabled = $isTopEnabled;
        $this->bannerUrl = $bannerUrl;
        $this->ageRating = $ageRating;
        $this->license = $license;
    }

}
