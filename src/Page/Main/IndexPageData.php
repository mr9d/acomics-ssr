<?php

namespace Acomics\Ssr\Page\Main;

use Acomics\Ssr\Dto\CoverDto;

class IndexPageData
{
    public string $magicHeadElements;

	/** @var CoverDto[] */
    public array $covers;

    /**
     * @param CoverDto[] $covers
     */
    public function __construct(
        string $magicHeadElements,
        array $covers,
    )
    {
        $this->magicHeadElements = $magicHeadElements;
        $this->covers = $covers;
    }
}
