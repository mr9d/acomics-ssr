<?php

namespace Acomics\Ssr\Page\Catalog;

use Acomics\Ssr\Dto\CatalogSerialDto;

class SearchResultPageData
{
    public ?string $query;

	/** @var CatalogSerialDto[] */
    public array $serials;

	public bool $hasMoreSerials;

    public int $skip;

    /** @param CatalogSerialDto[] $serials */
    public function __construct(
        ?string $query,
        array $serials,
        bool $hasMoreSerials,
        int $skip,
    )
    {
        $this->query = $query;
        $this->serials = $serials;
        $this->hasMoreSerials = $hasMoreSerials;
        $this->skip = $skip;
    }
}
