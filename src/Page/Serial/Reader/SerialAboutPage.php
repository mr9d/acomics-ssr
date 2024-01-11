<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\SerialCoauthorDto;
use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\Serial\Component\AboutBadges\AboutBadges;
use Acomics\Ssr\Layout\Serial\Component\IssuePreview\IssuePreview;
use Acomics\Ssr\Layout\SerialReaderAside\SerialReaderAsideLayout;
use Acomics\Ssr\Page\PageInt;
use Acomics\Ssr\Util\AuthorUtil;
use Acomics\Ssr\Util\UrlUtil;

class SerialAboutPage extends SerialReaderAsideLayout implements PageInt
{
	protected ?SerialAboutPageData $pageData = null;

	public function pageData(SerialAboutPageData $pageData): void
	{
		$this->pageData = $pageData;
	}

	public function isReady(): bool
	{
		return $this->pageData !== null && parent::isReady();
	}

	public function content(): void
	{
		(new PageHeaderWithMenu($this->pageData->serial->name))->render();

		(new AboutBadges(
			catalogStatus: $this->pageData->serial->catalogStatus,
			isTranslation: $this->pageData->serial->isTranslation,
			isCompleted: $this->pageData->serial->isCompleted,
			categories: $this->pageData->categories
		))->render();

		$this->renderAboutText();

		if($this->pageData->serial->siteUrl)
		{
			echo '<p><a href="' . UrlUtil::makeSerialUrl($this->pageData->serial->code) . '">https://acomics.ru' . UrlUtil::makeSerialUrl($this->pageData->serial->code) . '</a></p>';
		}

		if($this->pageData->serial->originalAuthorName)
		{
			echo '<p><b>Автор оригинала:</b> ' . $this->pageData->serial->originalAuthorName . '</p>';
		}

		$this->renderAuthors();

		echo '<p><b>Количество выпусков:</b> ' . $this->pageData->serial->issueCount . '</p>';
		echo '<p><b>Количество подписчиков:</b> <a href="' . UrlUtil::makeSerialUrl($this->pageData->serial->code, 'subscribe') . '">' . $this->pageData->serial->subscribersCount . '</a></p>';

		$this->renderOfficialSite();

		echo '<p><b>Возрастной рейтинг:</b> ' . $this->pageData->serial->ageRating->name . '</p>';

		$this->renderLicense();

		$this->renderIssues();

		$this->renderReadMenu();
	}

	private function renderAboutText(): void
	{
		echo '<section class="serial-about-text">';
		echo $this->pageData->aboutText;
		echo '</section>';
	}

	private function renderAuthors(): void
	{
		echo '<p class="serial-about-authors">' . AuthorUtil::makeAuthorsString($this->pageData->coauthors, $this->pageData->serial->isTranslation) . '</p>';
	}

	private function renderOfficialSite(): void
	{
		// Не выводим адрес официального сайта, если для перевода он не заполнен
		if ($this->pageData->serial->isTranslation && !$this->pageData->serial->siteUrl)
		{
			return;
		}

		$url = $this->pageData->serial->siteUrl ? $this->pageData->serial->siteUrl : 'https://acomics.ru' . UrlUtil::makeSerialUrl($this->pageData->serial->code);

		echo '<p class="serial-about-site-url">';

		echo '<b>' . ($this->pageData->serial->isTranslation ? 'Официальный сайт' : 'Сайт') . ':</b> ';
		echo '<a href="' . $url . '">' . $url . '</a>';

		echo '</p>';
	}

	private function renderLicense(): void
	{
		// Не выводим "Нет лицензии или не CC" без descriptionUrl
		if(!$this->pageData->serial->license || !$this->pageData->serial->license->descriptionUrl)
		{
			return;
		}

		echo '<p><b>Лицензия:</b> ';

		echo '<a href="' . $this->pageData->serial->license->descriptionUrl . '">' . $this->pageData->serial->license->name . '</a>';

		echo '</p>';
	}

	private function renderIssues(): void
	{
		echo '<section class="serial-about-issues">';

		foreach($this->pageData->issues as $issue)
		{
			(new IssuePreview($issue))->render();
		}

		echo '</section>'; // serial-about-issues
	}

	private function renderReadMenu(): void
	{
		echo '<nav class="serial-about-read-menu">';

		echo '<a href="' . UrlUtil::makeSerialUrl($this->pageData->serial->code, '1') . '">Читать комикс с начала</a>';
		echo '<a href="' . UrlUtil::makeSerialUrl($this->pageData->serial->code, 'content') . '">Cодержание комикса</a>';

		echo '</nav>'; // serial-about-read-menu
	}
}

