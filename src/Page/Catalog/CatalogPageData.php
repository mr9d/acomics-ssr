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

	/** @param CatalogSerialDto[] */
    public array $serials;

    public function __construct(
        SerialCategoryProviderInt $serialCategoryProvider,
        SerialAgeRatingProviderInt $serialAgeRatingProvider,
        CatalogFiltersDto $filters
    )
    {
        $this->serialCategoryProvider = $serialCategoryProvider;
        $this->serialAgeRatingProvider = $serialAgeRatingProvider;
        $this->filters = $filters;
    }
}
