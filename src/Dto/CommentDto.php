<?php

namespace Acomics\Ssr\Dto;

class CommentDto
{
	public int $id;
	public UserDto $user;
	public ?string $userSerialRole;
	public ?string $ipAddress;
	public int $postDate;
	public string $text;
	public bool $isEditable;

    public string $serialCode;
    public string $serialName;
    public string $issueNumber;
    public ?string $issueName;

	public function __construct(
		int $id,
		UserDto $user,
		?string $userSerialRole,
		?string $ipAddress,
		int $postDate,
		string $text,
		bool $isEditable,
        string $serialCode,
        string $serialName,
        string $issueNumber,
        ?string $issueName)
	{
		$this->id = $id;
		$this->user = $user;
		$this->userSerialRole = $userSerialRole;
		$this->ipAddress = $ipAddress;
		$this->postDate = $postDate;
		$this->text = $text;
		$this->isEditable = $isEditable;
        $this->serialCode = $serialCode;
        $this->serialName = $serialName;
        $this->issueNumber = $issueNumber;
        $this->issueName = $issueName;
	}
}
