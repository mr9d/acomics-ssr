<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\SerialAgeRatingDto;

class SerialAgeRestrictionPageData
{
    public SerialAgeRatingDto $ageRating;

    public function __construct(SerialAgeRatingDto $ageRating)
    {
        $this->ageRating = $ageRating;
    }
}
