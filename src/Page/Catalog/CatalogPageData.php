<?php

namespace Acomics\Ssr\Page\Catalog;

use Acomics\Ssr\Dto\CatalogFiltersDto;
use Acomics\Ssr\Dto\CatalogSerialDto;
use Acomics\Ssr\Util\Ref\SerialAgeRatingProviderInt;
use Acomics\Ssr\Util\Ref\SerialCategoryProviderInt;

class CatalogPageData
{
    public SerialCategoryProviderInt $serialCategoryProvider;

    public SerialAgeRatingProviderInt $serialAgeRatingProvider;

    public CatalogFiltersDto $filters;

	/** @var CatalogSerialDto[] */
    public array $serials;

	public bool $hasMoreSerials;

    public int $skip;

    /** @param CatalogSerialDto[] $serials */
    public function __construct(
        SerialCategoryProviderInt $serialCategoryProvider,
        SerialAgeRatingProviderInt $serialAgeRatingProvider,
        CatalogFiltersDto $filters,
        array $serials,
        bool $hasMoreSerials,
        int $skip,
    )
    {
        $this->serialCategoryProvider = $serialCategoryProvider;
        $this->serialAgeRatingProvider = $serialAgeRatingProvider;
        $this->filters = $filters;
        $this->serials = $serials;
        $this->hasMoreSerials = $hasMoreSerials;
        $this->skip = $skip;
    }
}
