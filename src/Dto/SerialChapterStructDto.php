<?php

namespace Acomics\Ssr\Dto;

class SerialChapterStructDto
{
    public const LEVEL_ROOT = 0;
    public const LEVEL_TOP = 1;
    public const LEVEL_SUBTITLE = 2;
    public const LEVEL_SUBTITLE_COLLAPSE = 3;

	public int $headerLevel;
	public string $name;

	/** @var ?SerialChapterDto[] $chapters */
	public ?array $chapters;

	/** @var ?SerialChapterStructDto[] $childStructs */
	public ?array $childStructs;

    /**
     * @param ?SerialChapterDto[] $chapters
     * @param ?SerialChapterStructDto[] $childStructs
     */
	public function __construct(int $headerLevel, string $name, ?array $chapters, ?array $childStructs)
	{
		$this->headerLevel = $headerLevel;
		$this->name = $name;
		$this->chapters = $chapters;
		$this->childStructs = $childStructs;
	}
}
