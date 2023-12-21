<?php

namespace Acomics\Ssr\Page\Serial\Reader;

class SerialViewPageData
{
	public int $issueNumber;

	public ?string $issueName;

	public function __construct(
		int $issueNumber,
		?string $issueName)
	{
		$this->issueNumber = $issueNumber;
		$this->issueName = $issueName;
	}
}
