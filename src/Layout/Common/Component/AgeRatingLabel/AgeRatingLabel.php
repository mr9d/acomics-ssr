<?php

namespace Acomics\Ssr\Layout\Common\Component\AgeRatingLabel;

use Acomics\Ssr\Dto\SerialAgeRatingDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Service\Dictionary\SerialAgeRatingDictionary;

class AgeRatingLabel extends AbstractComponent
{
	private SerialAgeRatingDto $ageRating;

	public function __construct(int $ageRatingId)
	{
		$this->ageRating = SerialAgeRatingDictionary::instance()->getById($ageRatingId);
	}

    function render(): void
    {
        echo '<a href="/rating" class="age-rating-label rating' . $this->ageRating->id . '">' . $this->ageRating->nameShort . '</a>';
    }
}
