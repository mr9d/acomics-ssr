<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\SerialCharacterDto;

class SerialCharactersPageData
{
    /** @var SerialCharacterDto[] $characters */
    public array $characters;

    /** @param SerialCharacterDto[] $characters */
    public function __construct(array $characters)
    {
        $this->characters = $characters;
    }
}
