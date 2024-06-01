<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderSerialDescription;

use Acomics\Ssr\Dto\SerialCoauthorDto;
use Acomics\Ssr\Dto\ReaderSerialDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Common\Component\AgeRatingIcon\AgeRatingIcon;
use Acomics\Ssr\Layout\Common\Component\LicenseIcon\LicenseIcon;
use Acomics\Ssr\Service\Dictionary\SerialAgeRatingDictionary;
use Acomics\Ssr\Service\Dictionary\SerialLicenseDictionary;
use Acomics\Ssr\Util\AuthorUtil;
use Acomics\Ssr\Util\Ref\SerialAgeRatingProviderInt;
use Acomics\Ssr\Util\Ref\SerialLicenseProviderInt;
use Acomics\Ssr\Util\UrlUtil;

class ReaderSerialDescription extends AbstractComponent
{
	private ReaderSerialDto $serial;

	/** @var SerialCoauthorDto[] $coauthors */
	private array $coauthors;

    private SerialLicenseProviderInt $serialLicenseProvider;

	/**
	 * @param SerialCoauthorDto[] $coauthors
	 */
	public function __construct(ReaderSerialDto $serial, array $coauthors)
	{
		$this->serial = $serial;
		$this->coauthors = $coauthors;
        $this->serialLicenseProvider = SerialLicenseDictionary::instance();
	}

	public function render(): void
	{
		echo '<section class="reader-serial-description">';

		$this->renderCommon();
		$this->renderIcons();
		$this->renderUpButton();

		echo '</section>'; // reader-serial-description
	}

	private function renderCommon(): void
	{
		echo '<div class="description-common">';

		echo '<h2>' . $this->serial->name . '</h2>';

		if($this->serial->aboutShort !== null)
		{
			echo '<p>' . $this->serial->aboutShort . '</p>';
		}

		if($this->serial->originalAuthorName !== null)
		{
			echo '<p><b>Автор оригинала:</b> ' . $this->serial->originalAuthorName . '</p>';
		}

		$url = $this->serial->siteUrl ? $this->serial->siteUrl : 'https://acomics.ru' . UrlUtil::makeSerialUrl($this->serial->code);
		echo '<p><b>' . ($this->serial->isTranslation ? 'Официальный сайт' : 'Сайт') . ':</b> <a href="' . $url . '">' . $url . '</a></p>';

		echo '<p>' . AuthorUtil::makeAuthorsString($this->coauthors, $this->serial->isTranslation) . '</p>';

		echo '</div>';
	}

	private function renderIcons(): void
	{
        $license = $this->serialLicenseProvider->getById($this->serial->licenseId);

		echo '<div class="description-icons">';

		if ($license && $license->descriptionUrl !== null)
		{
			echo '<p>';
            (new LicenseIcon($this->serial->licenseId))->render();
            echo '</p>';
		}

		echo '<p>';
        (new AgeRatingIcon($this->serial->ageRatingId))->render();
        echo '</p>';

		echo '</div>';
	}

	private function renderUpButton(): void
	{
		echo '<a href="#" class="description-up-button">Наверх &uarr;</a>';
	}
}
