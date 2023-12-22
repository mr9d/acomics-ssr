<?php

namespace Acomics\Ssr\Page\Serial\Reader;

class SerialViewPageData
{
	public int $issueNumber;

	public ?string $issueName;

	public string $issueImageUrl;

	public int $issueImageWidth;

	public int $issueImageHeight;

	public function __construct(
		int $issueNumber,
		?string $issueName,
		string $issueImageUrl,
		int $issueImageWidth,
		int $issueImageHeight)
	{
		$this->issueNumber = $issueNumber;
		$this->issueName = $issueName;
		$this->issueImageUrl = $issueImageUrl;
		$this->issueImageWidth = $issueImageWidth;
		$this->issueImageHeight = $issueImageHeight;
	}
}
