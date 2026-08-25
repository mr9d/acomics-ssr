<?php

namespace Acomics\Ssr\Util\Url;

final class AcomicsUrl implements \Stringable
{
	private const ORIGIN = 'https://acomics.ru';

	public function __construct(private readonly string $path)
	{
	}

	public function __toString(): string
	{
		return $this->path;
	}

	public function absolute(): string
	{
		return self::ORIGIN . $this->path;
	}
}
