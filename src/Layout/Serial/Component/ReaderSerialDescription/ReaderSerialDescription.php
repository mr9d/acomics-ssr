<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderSerialDescription;

use Acomics\Ssr\Dto\SerialCoauthorDto;
use Acomics\Ssr\Dto\ReaderSerialDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Util\AuthorUtil;
use Acomics\Ssr\Util\UrlUtil;

class ReaderSerialDescription extends AbstractComponent
{
	private ReaderSerialDto $serial;

	/** @var SerialCoauthorDto[] $coauthors */
	private array $coauthors;

	/**
	 * @param SerialCoauthorDto[] $coauthors
	 */
	public function __construct(ReaderSerialDto $serial, array $coauthors)
	{
		$this->serial = $serial;
		$this->coauthors = $coauthors;
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
		echo '<div class="description-icons">';

		if ($this->serial->license->descriptionUrl !== null)
		{
			echo '<p><a href="' . $this->serial->license->descriptionUrl . '"><img src="' . $this->serial->license->iconUrl . '" alt="' . $this->serial->license->name . '" /></a></p>';
		}

		echo '<p><a class="description-icon-rating" href="/rating">' . $this->serial->ageRating->nameShort . '</a></p>';

		echo '</div>';
	}

	private function renderUpButton(): void
	{
		echo '<a href="#" class="description-up-button">Наверх &uarr;</a>';
	}
}
