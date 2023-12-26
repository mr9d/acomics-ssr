<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderIssueDescription;

use Acomics\Ssr\Dto\IssueDto;
use Acomics\Ssr\Dto\SerialDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Common\Component\DateTimeFormatted\DateTimeFormatted;
use Acomics\Ssr\Util\UrlUtil;

class ReaderIssueDescription extends AbstractComponent
{
	private SerialDto $serial;

	private IssueDto $issue;

	public function __construct(
		SerialDto $serial,
		IssueDto $issue)
	{
		$this->serial = $serial;
		$this->issue = $issue;
	}

	public function render(): void
	{
		echo '<article class="reader-issue-description">';

		$this->renderAvatar();
		$this->renderTitle();
		$this->renderDescription();

		if ($this->issue->editId !== null)
		{
			$this->renderEdit();
		}

		$this->renderButtons();

		echo '</article>'; // reader-issue-description
	}

	private function renderAvatar(): void
	{
		echo '<a class="issue-description-avatar" href="' . UrlUtil::makeProfileUrl($this->issue->user->name) . '"><img src="' . $this->issue->user->avatarUrl . '" width="40" height="40"></a>';
	}

	private function renderTitle(): void
	{
		echo '<h2 class="issue-description-title">';

		echo '<a class="username" href="' . UrlUtil::makeProfileUrl($this->issue->user->name) .'">' . $this->issue->user->name . '</a>';
		echo '<span class="title">' . ($this->issue->name ? $this->issue->name : 'Выпуск №' . $this->issue->number) . '</span>';

		(new DateTimeFormatted($this->issue->postDate))->render();

		echo '</h2>'; // issue-description-title
	}

	private function renderDescription(): void
	{
		if ($this->issue->description === null)
		{
			echo '<section class="issue-description-text empty"></section>';
		}
		else
		{
			echo '<section class="issue-description-text">';
			echo $this->issue->description;
			echo '</section>'; // issue-description-text
		}
	}

	private function renderEdit(): void
	{
		echo '<section class="issue-description-edit">';
		echo '<a href="/manage/issue?id=' . $this->issue->editId . '">редактировать</a>';
		echo '</section>'; // issue-description-buttons
	}

	private function renderButtons(): void
	{
		echo '<section class="issue-description-buttons">';
		echo 456;
		echo '</section>'; // issue-description-buttons
	}
}
