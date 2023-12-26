<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\CommentDto;
use Acomics\Ssr\Dto\IssueDto;
use Acomics\Ssr\Dto\SerialDto;

class SerialViewPageData
{
	public SerialDto $serial;

	public IssueDto $issue;

	/** @param CommentDto[] */
	public array $comments;

	public bool $commentsAllowed;

	public ?string $commentsDisallowMessage;

	public function __construct(
		SerialDto $serial,
		IssueDto $issue,
		array $comments,
		bool $commentsAllowed,
		?string $commentsDisallowMessage)
	{
		$this->serial = $serial;
		$this->issue = $issue;
		$this->comments = $comments;
		$this->commentsAllowed = $commentsAllowed;
		$this->commentsDisallowMessage = $commentsDisallowMessage;
	}
}
