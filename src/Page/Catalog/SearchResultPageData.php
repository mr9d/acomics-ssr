<?php

namespace Acomics\Ssr\Page\Catalog;

use Acomics\Ssr\Dto\CatalogSerialDto;

class SearchResultPageData
{
    public ?string $query;

	/** @var CatalogSerialDto[] */
    public array $serials;

    /** @param CatalogSerialDto[] $serials */
    public function __construct(?string $query, array $serials)
    {
        $this->query = $query;
        $this->serials = $serials;
    }
}
