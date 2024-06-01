<?php

namespace Acomics\Ssr\Page\Serial\Reader;

class SerialAgeRestrictionPageData
{
    public int $ageRatingId;

    public function __construct(int $ageRatingId)
    {
        $this->ageRatingId = $ageRatingId;
    }
}
