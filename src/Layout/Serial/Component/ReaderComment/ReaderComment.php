<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderComment;

use Acomics\Ssr\Dto\CommentDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Common\Component\DateTimeFormatted\DateTimeFormatted;
use Acomics\Ssr\Layout\Common\Component\LazyImage\LazyImage;
use Acomics\Ssr\Util\UrlUtil;

class ReaderComment extends AbstractComponent
{
    public const LINK_TYPE_NONE = 'none';
    public const LINK_TYPE_ISSUE = 'issue';
    public const LINK_TYPE_SERIAL_ISSUE = 'serialIssue';

	private CommentDto $comment;
    private string $linkType;

	public function __construct(CommentDto $comment, $linkType = self::LINK_TYPE_NONE)
	{
		$this->comment = $comment;
        $this->linkType = $linkType;
	}

	public function render(): void
	{
		$class = 'reader-comment' . ($this->comment->userSerialRole !== null ? ' authors' : '');

        $this->renderLinks();

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

    private function renderLinks(): void
    {
        if($this->linkType === self::LINK_TYPE_NONE)
        {
            return;
        }

        echo '<nav class="reader-comment-links">';
        echo '&darr; ';

        if($this->linkType !== self::LINK_TYPE_ISSUE)
        {
            echo '<a href="' . UrlUtil::makeSerialUrl($this->comment->serialCode, $this->comment->issueNumber) . '">' . $this->comment->serialName . '</a> &ndash; ';
        }

        echo '<a href="' . UrlUtil::makeSerialUrl($this->comment->serialCode, $this->comment->issueNumber) . '">Выпуск №' . $this->comment->issueNumber . ($this->comment->issueName ? ': '.$this->comment->issueName : '') . '</a>';

        echo '</nav>'; // reader-comment-links
    }

	private function renderAvatar(): void
	{
		echo '<section class="comment-avatar">';

		if ($this->comment->user->isAnonymous)
		{
			echo '<img src="/static/img/avatar-stub.svg" alt="Изображение анонимного пользователя" width="40" height="40">';
		}
		else
		{
			echo '<a href="' . UrlUtil::makeProfileUrl($this->comment->user->name) . '" aria-label="Профиль пользователя ' . $this->comment->user->name . '">';

			(new LazyImage(
				src: $this->comment->user->avatarUrl ? $this->comment->user->avatarUrl : '/static/img/avatar-stub.svg',
				stubSrc: '/static/img/avatar-stub.svg',
				width: 40,
				height: 40,
				alt: 'Изображение пользователя ' . $this->comment->user->name,
			))->render();

			echo '</a>';
		}

		echo '<div class="comment-tail"></div>';

		echo '</section>'; // comment-avatar
	}

	private function renderInfo(): void
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

	private function renderText(): void
	{
		echo '<section class="comment-text">';
		echo $this->comment->text;
		echo '<button class="comment-expand">Читать дальше</button>';
		echo '<button class="comment-collapse">Свернуть</button>';
		echo '</section>'; // comment-text
	}

	private function renderEditButton(): void
	{
		echo '<section class="comment-edit">';
		echo '<a href="/manage/comment?id=' . $this->comment->id . '">редактировать</a>';
		echo '</section>'; // comment-edit
	}

}
