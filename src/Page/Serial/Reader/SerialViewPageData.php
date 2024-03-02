<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\CommentDto;
use Acomics\Ssr\Dto\SerialCoauthorDto;
use Acomics\Ssr\Dto\ReaderIssueDto;
use Acomics\Ssr\Dto\ReaderSerialDto;

class SerialViewPageData
{
	public ReaderSerialDto $serial;

	public ReaderIssueDto $issue;

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
		ReaderSerialDto $serial,
		ReaderIssueDto $issue,
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
