<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\SerialFaqDto;

class SerialFaqPageData
{
    /** @var SerialFaqDto[] $questions */
    public array $questions;

    /** @param SerialFaqDto[] $questions */
    public function __construct(array $questions)
    {
        $this->questions = $questions;
    }
}
