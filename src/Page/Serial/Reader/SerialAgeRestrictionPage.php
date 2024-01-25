<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Layout\Common\Component\LazyImage\LazyImage;
use Acomics\Ssr\Layout\SerialReader\SerialReaderLayout;
use Acomics\Ssr\Page\PageInt;

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
            src: '/design/images/darks-censored.png',
            stubSrc: '/design/images/darks-censored.png',
            width: 600,
            height: 400,
            alt: 'Даркс предупреждает о возрастном ограничении комикса',
            class: 'illustration'
        ))->render();

        echo '<p>Данный комикс содержит материалы, не подходящие для детей. <b><img src="' . $this->pageData->ageRating->iconUrl . '" alt="Иконка возрастного рейтинга ' . $this->pageData->ageRating->nameShort . '">' . $this->pageData->ageRating->name . '</b></p>';

        $this->form();

        echo '</section>'; // serial-age-restriction
    }

    private function form(): void
    {
        echo '<form method="post">';
        echo '<button name="ageRestrict" value="' . $this->pageData->ageRating->ageRestrict . '">Мне уже есть 18 лет</button>';
        echo '<button name="ageRestrict" value="no">Мне еще нет 18 лет</button>';
        echo '</form>';
    }
}
