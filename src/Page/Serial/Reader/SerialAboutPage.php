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
		(new PageHeaderWithMenu($this->serialLayoutData->name))->render();

		(new AboutBadges(
			catalogStatus: $this->pageData->catalogStatus,
			isTranslation: $this->pageData->isTranslation,
			isCompleted: $this->pageData->isCompleted,
			serialCategories: $this->pageData->serialCategories
		))->render();

		$this->renderAboutText();

		if($this->pageData->siteUrl)
		{
			echo '<p><a href="' . UrlUtil::makeSerialUrl($this->serialLayoutData->code) . '">https://acomics.ru' . UrlUtil::makeSerialUrl($this->serialLayoutData->code) . '</a></p>';
		}

		if($this->pageData->originalAuthorName)
		{
			echo '<p><b>Автор оригинала:</b> ' . $this->pageData->originalAuthorName . '</p>';
		}

		$this->renderAuthors();

		echo '<p><b>Количество выпусков:</b> ' . $this->serialLayoutData->issueCount . '</p>';
		echo '<p><b>Количество подписчиков:</b> <a href="' . UrlUtil::makeSerialUrl($this->serialLayoutData->code, 'subscribe') . '">' . $this->pageData->subscribersCount . '</a></p>';

		$this->renderOfficialSite();

		echo '<p><b>Возрастной рейтинг:</b> ' . $this->pageData->ageRating->name . '</p>';

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
		echo '<p class="serial-about-authors">';

		if($this->pageData->isTranslation)
		{
			if(count($this->pageData->coauthors) > 1)
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
			if(count($this->pageData->coauthors) > 1)
			{
				echo '<b>Авторы:</b> ';
			}
			else
			{
				echo '<b>Автор:</b> ';
			}
		}

		$coauthorToString = fn(SerialCoauthorDto $coauthor) => '<a href="' . UrlUtil::makeProfileUrl($coauthor->username) . '">' . $coauthor->username . '</a>' . ($coauthor->role ? ' (' . $coauthor->role . ')' : '');

		echo implode(', ', array_map($coauthorToString, $this->pageData->coauthors));

		echo '</p>';
	}

	private function renderOfficialSite(): void
	{
		// Не выводим адрес официального сайта, если для перевода он не заполнен
		if ($this->pageData->isTranslation && !$this->pageData->siteUrl)
		{
			return;
		}

		$url = $this->pageData->siteUrl ? $this->pageData->siteUrl : 'https://acomics.ru' . UrlUtil::makeSerialUrl($this->serialLayoutData->code);

		echo '<p class="serial-about-site-url">';

		echo '<b>' . ($this->pageData->isTranslation ? 'Официальный сайт' : 'Сайт') . ':</b> ';
		echo '<a href="' . $url . '">' . $url . '</a>';

		echo '</p>';
	}

	private function renderLicense(): void
	{
		// Не выводим "Нет лицензии или не CC" без descriptionUrl
		if(!$this->pageData->license || !$this->pageData->license->descriptionUrl)
		{
			return;
		}

		echo '<p><b>Лицензия:</b> ';

		echo '<a href="' . $this->pageData->license->descriptionUrl . '">' . $this->pageData->license->name . '</a>';

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

		echo '<a href="' . UrlUtil::makeSerialUrl($this->serialLayoutData->code, '1') . '">Читать комикс с начала</a>';
		echo '<a href="' . UrlUtil::makeSerialUrl($this->serialLayoutData->code, 'content') . '">Cодержание комикса</a>';

		echo '</nav>'; // serial-about-read-menu
	}
}

