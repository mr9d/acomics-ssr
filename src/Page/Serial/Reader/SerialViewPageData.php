<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\CommentDto;
use Acomics\Ssr\Dto\SerialCoauthorDto;
use Acomics\Ssr\Dto\IssueDto;
use Acomics\Ssr\Dto\SerialDto;

class SerialViewPageData
{
	public SerialDto $serial;

	public IssueDto $issue;

	/** @var SerialCoauthorDto[] $coauthors */
	public array $coauthors;

	/** @param CommentDto[] */
	public array $comments;

	public bool $commentsAllowed;

	public ?string $commentsDisallowMessage;

	/**
	 * @param SerialCoauthorDto[] $coauthors
	 */
	public function __construct(
		SerialDto $serial,
		IssueDto $issue,
		array $coauthors,
		array $comments,
		bool $commentsAllowed,
		?string $commentsDisallowMessage)
	{
		$this->serial = $serial;
		$this->issue = $issue;
		$this->coauthors = $coauthors;
		$this->comments = $comments;
		$this->commentsAllowed = $commentsAllowed;
		$this->commentsDisallowMessage = $commentsDisallowMessage;
	}
}
