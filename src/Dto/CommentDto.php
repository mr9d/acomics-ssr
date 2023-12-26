<?php

namespace Acomics\Ssr\Dto;

class CommentDto
{
	public int $id;
	public UserDto $user;
	public ?string $ipAddress;
	public int $postDate;
	public string $text;
	public bool $isEditable;

	public function __construct(
		int $id,
		UserDto $user,
		?string $ipAddress,
		int $postDate,
		string $text,
		bool $isEditable)
	{
		$this->id = $id;
		$this->user = $user;
		$this->ipAddress = $ipAddress;
		$this->postDate = $postDate;
		$this->text = $text;
		$this->isEditable = $isEditable;
	}
}
