<?php

namespace Acomics\Ssr\Util\Url;

final class AcomicsUrl implements \Stringable
{
	public function __construct(
		private readonly string $path,
		private readonly string $origin,
	)
	{}

	public function __toString(): string
	{
		return $this->path;
	}

	public function absolute(): string
	{
		return $this->origin . $this->path;
	}
}
