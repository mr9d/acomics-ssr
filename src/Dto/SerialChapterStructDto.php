<?php

namespace Acomics\Ssr\Dto;

class SerialChapterStructDto
{
	public int $headerLevel;
	public string $name;

	/** @var ?SerialChapterDto[] $chapters */
	public ?array $chapters;

	/** @var ?SerialChapterStructDto[] $childStructs */
	public ?array $childStructs;

	public function __construct(int $headerLevel, string $name, ?array $chapters, ?array $childStructs)
	{
		$this->headerLevel = $headerLevel;
		$this->name = $name;
		$this->chapters = $chapters;
		$this->childStructs = $childStructs;
	}
}
