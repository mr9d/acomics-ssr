<?php

namespace Acomics\Ssr\Layout\Common;

class PageHintData
{
	public const DEFAULT_TYPE = 'default';
	public const EXCLAMATION_TYPE = 'exclamation';
	public const WARNING_TYPE = 'warning';

	public string $text;

	public string $type;

	public ?string $closeButtonId;

	public function __construct(string $text, string $type = self::DEFAULT_TYPE, ?string $closeButtonId = null)
	{
		$this->text = $text;
		$this->type = $type;
		$this->closeButtonId = $closeButtonId;
	}
}
