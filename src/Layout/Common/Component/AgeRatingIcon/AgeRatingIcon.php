<?php

namespace Acomics\Ssr\Layout\Common\Component\AgeRatingIcon;

use Acomics\Ssr\Dto\SerialAgeRatingDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Service\Dictionary\SerialAgeRatingDictionary;

class AgeRatingIcon extends AbstractComponent
{
    private SerialAgeRatingDto $ageRating;

    public function __construct(int $ageRatingId)
    {
        $this->ageRating = SerialAgeRatingDictionary::instance()->getById($ageRatingId);
    }

    public function render(): void
    {
        $title = 'Возрастной рейтинг ' . $this->ageRating->name;
        echo '<a class="age-rating-icon age-rating-icon-id' . $this->ageRating->id . '" href="/rating" title="' . $title . '"></a>';
    }
}
