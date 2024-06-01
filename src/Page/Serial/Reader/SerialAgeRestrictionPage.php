<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Layout\Common\Component\AgeRatingIcon\AgeRatingIcon;
use Acomics\Ssr\Layout\Common\Component\LazyImage\LazyImage;
use Acomics\Ssr\Layout\SerialReader\SerialReaderLayout;
use Acomics\Ssr\Page\PageInt;
use Acomics\Ssr\Service\Dictionary\SerialAgeRatingDictionary;

class SerialAgeRestrictionPage extends SerialReaderLayout implements PageInt
{
	protected ?SerialAgeRestrictionPageData $pageData = null;

	public function pageData(SerialAgeRestrictionPageData $pageData): void
	{
		$this->pageData = $pageData;
	}

	public function isReady(): bool
	{
		return $this->pageData !== null && parent::isReady();
	}

    public function content(): void
    {

        echo '<section class="serial-age-restriction">';

        (new LazyImage(
            src: '/design/images/darks-censored-2.png',
            stubSrc: '/design/images/darks-censored-2.png',
            width: 600,
            height: 400,
            alt: 'Даркс предупреждает о возрастном ограничении комикса',
            class: 'illustration'
        ))->render();

        echo '<p>Данный комикс содержит материалы, не подходящие для детей.</p>';

        echo '<p>';
        (new AgeRatingIcon($this->pageData->ageRatingId))->render();
        echo '</p>';

        $this->form();

        echo '</section>'; // serial-age-restriction
    }

    private function form(): void
    {
        $ageRating = SerialAgeRatingDictionary::instance()->getById($this->pageData->ageRatingId);

        echo '<form method="post">';
        echo '<button name="ageRestrict" value="' . $ageRating->ageRestrict . '">Мне уже есть 18 лет</button>';
        echo '<button name="ageRestrict" value="no">Мне еще нет 18 лет</button>';
        echo '</form>';
    }
}
