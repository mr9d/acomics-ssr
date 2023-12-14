<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\SerialCoauthorDto;
use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\Serial\Component\AboutBadges\AboutBadges;
use Acomics\Ssr\Layout\Serial\Component\IssuePreview\IssuePreview;
use Acomics\Ssr\Layout\SerialReaderAside\SerialReaderAsideLayout;
use Acomics\Ssr\Page\PageInt;
use Acomics\Ssr\Util\UrlUtil;

class SerialAboutPage extends SerialReaderAsideLayout implements PageInt
{
	protected ?SerialAboutPageData $serialAboutPageData = null;

	public function pageData(SerialAboutPageData $serialAboutPageData): void
	{
		$this->serialAboutPageData = $serialAboutPageData;
	}

	public function isReady(): bool
	{
		return $this->serialAboutPageData !== null && parent::isReady();
	}

	public function content(): void
	{
		(new PageHeaderWithMenu($this->serialLayoutData->name))->render();

		(new AboutBadges(
			catalogStatus: $this->serialAboutPageData->catalogStatus,
			isTranslation: $this->serialAboutPageData->isTranslation,
			isCompleted: $this->serialAboutPageData->isCompleted,
			serialCategories: $this->serialAboutPageData->serialCategories
		))->render();

		$this->renderAboutText();

		if($this->serialAboutPageData->siteUrl)
		{
			echo '<p><a href="' . UrlUtil::makeSerialUrl($this->serialLayoutData->code) . '">https://acomics.ru' . UrlUtil::makeSerialUrl($this->serialLayoutData->code) . '</a></p>';
		}

		if($this->serialAboutPageData->originalAuthorName)
		{
			echo '<p><b>Автор оригинала:</b> ' . $this->serialAboutPageData->originalAuthorName . '</p>';
		}

		$this->renderAuthors();

		echo '<p><b>Количество выпусков:</b> ' . $this->serialLayoutData->issueCount . '</p>';
		echo '<p><b>Количество подписчиков:</b> <a href="' . UrlUtil::makeSerialUrl($this->serialLayoutData->code, 'subscribe') . '">' . $this->serialAboutPageData->subscribersCount . '</a></p>';

		$this->renderOfficialSite();

		echo '<p><b>Возрастной рейтинг:</b> ' . $this->serialAboutPageData->ageRating->name . '</p>';

		$this->renderLicense();

		$this->renderIssues();

		$this->renderReadMenu();
	}

	private function renderAboutText(): void
	{
		echo '<section class="serial-about-text">';
		echo $this->serialAboutPageData->aboutText;
		echo '</section>';
	}

	private function renderAuthors(): void
	{
		echo '<p class="serial-about-authors">';

		if($this->serialAboutPageData->isTranslation)
		{
			if(count($this->serialAboutPageData->coauthors) > 1)
			{
				echo '<b>Переводчики:</b> ';
			}
			else
			{
				echo '<b>Переводчик:</b> ';
			}
		}
		else
		{
			if(count($this->serialAboutPageData->coauthors) > 1)
			{
				echo '<b>Авторы:</b> ';
			}
			else
			{
				echo '<b>Автор:</b> ';
			}
		}

		$coauthorToString = fn(SerialCoauthorDto $coauthor) => '<a href="' . UrlUtil::makeProfileUrl($coauthor->username) . '">' . $coauthor->username . '</a>' . ($coauthor->role ? ' (' . $coauthor->role . ')' : '');

		echo implode(', ', array_map($coauthorToString, $this->serialAboutPageData->coauthors));

		echo '</p>';
	}

	private function renderOfficialSite(): void
	{
		// Не выводим адрес официального сайта, если для перевода он не заполнен
		if ($this->serialAboutPageData->isTranslation && !$this->serialAboutPageData->siteUrl)
		{
			return;
		}

		$url = $this->serialAboutPageData->siteUrl ? $this->serialAboutPageData->siteUrl : 'https://acomics.ru' . UrlUtil::makeSerialUrl($this->serialLayoutData->code);

		echo '<p class="serial-about-site-url">';

		echo '<b>' . ($this->serialAboutPageData->isTranslation ? 'Официальный сайт' : 'Сайт') . ':</b> ';
		echo '<a href="' . $url . '">' . $url . '</a>';

		echo '</p>';
	}

	private function renderLicense(): void
	{
		// Не выводим "Нет лицензии или не CC" без descriptionUrl
		if(!$this->serialAboutPageData->license || !$this->serialAboutPageData->license->descriptionUrl)
		{
			return;
		}

		echo '<p><b>Лицензия:</b> ';

		echo '<a href="' . $this->serialAboutPageData->license->descriptionUrl . '">' . $this->serialAboutPageData->license->name . '</a>';

		echo '</p>';
	}

	private function renderIssues(): void
	{
		echo '<section class="serial-about-issues">';

		foreach($this->serialAboutPageData->issues as $issue)
		{
			(new IssuePreview($issue))->render();
		}

		echo '</section>'; // serial-about-issues
	}

	private function renderReadMenu(): void
	{
		echo '<nav class="serial-about-read-menu">';

		echo '<a href="' . UrlUtil::makeSerialUrl($this->serialLayoutData->code, '1') . '">Читать комикс с начала</a>';
		echo '<a href="' . UrlUtil::makeSerialUrl($this->serialLayoutData->code, 'content') . '">Cодержание комикса</a>';

		echo '</nav>'; // serial-about-read-menu
	}
}

