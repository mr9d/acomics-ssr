<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderComment;

use Acomics\Ssr\Dto\CommentDto;
use Acomics\Ssr\Layout\AbstractComponent;

class ReaderComment extends AbstractComponent
{
	private CommentDto $comment;

	public function __construct(CommentDto $comment)
	{
		$this->comment = $comment;
	}

	public function render(): void
	{
		echo '<article class="reader-comment">';
		echo $this->comment->text;
		echo '</article>'; // reader-comment
	}
}
