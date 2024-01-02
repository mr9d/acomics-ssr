<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderComment;

use Acomics\Ssr\Dto\CommentDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Common\Component\DateTimeFormatted\DateTimeFormatted;
use Acomics\Ssr\Util\UrlUtil;

class ReaderComment extends AbstractComponent
{
	private CommentDto $comment;

	public function __construct(CommentDto $comment)
	{
		$this->comment = $comment;
	}

	public function render(): void
	{
		$class = 'reader-comment' . ($this->comment->userSerialRole !== null ? ' authors' : '');

		echo '<article class="' . $class . '" id="comment' . $this->comment->id . '">';
		$this->renderAvatar();
		$this->renderInfo();
		$this->renderText();

		if ($this->comment->isEditable)
		{
			$this->renderEditButton();
		}

		echo '</article>'; // reader-comment
	}

	public function renderAvatar(): void
	{
		echo '<section class="comment-avatar">';

		if (!$this->comment->user->isAnonymous)
		{
			echo '<a href="' . UrlUtil::makeProfileUrl($this->comment->user->name) . '" aria-label="Профиль пользователя ' . $this->comment->user->name . '">';
		}

		echo '<img src="' . $this->comment->user->avatarUrl . '" alt="Изображение пользователя ' . $this->comment->user->name . '" width="40" height="40">';

		if (!$this->comment->user->isAnonymous)
		{
			echo '</a>';
		}

		echo '<div class="comment-tail"></div>';

		echo '</section>'; // comment-avatar
	}

	public function renderInfo(): void
	{
		echo '<section class="comment-info">';

		// Идентификатор
		echo '<span class="comment-id"><a href="#comment' . $this->comment->id . '">#' . $this->comment->id . '</a></span>';

		// Имя пользователя
		echo '<span class="comment-username">';
		if (!$this->comment->user->isAnonymous)
		{
			echo '<a href="' . UrlUtil::makeProfileUrl($this->comment->user->name) . '">';
		}
		echo $this->comment->user->name;
		if (!$this->comment->user->isAnonymous)
		{
			echo '</a>';
		}
		echo '</span>'; // comment-username

		// Роль
		if($this->comment->userSerialRole !== null)
		{
			echo '<span class="comment-role">' . $this->comment->userSerialRole . '</span>';
		}

		// IP-адрес
		if($this->comment->ipAddress)
		{
			echo '<span class="comment-ipaddress">(' . $this->comment->ipAddress . ')</span>';
		}

		// Дата и время
		(new DateTimeFormatted($this->comment->postDate))->render();

		echo '</section>'; // comment-info
	}

	public function renderText(): void
	{
		echo '<section class="comment-text">';
		echo $this->comment->text;
		echo '<button class="comment-expand">Читать дальше</button>';
		echo '<button class="comment-collapse">Свернуть</button>';
		echo '</section>'; // comment-text
	}

	public function renderEditButton(): void
	{
		echo '<section class="comment-edit">';
		echo '<a href="/manage/comment?id=' . $this->comment->id . '">редактировать</a>';
		echo '</section>'; // comment-edit
	}

}
