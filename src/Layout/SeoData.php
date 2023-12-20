<?php

namespace Acomics\Ssr\Layout;

class SeoData
{
    public string $description;

	/** @var string[] */
    public array $keywords;

	/** @param string[] $keywords */
	public function __construct(string $description, array $keywords)
	{
		$this->description = $description;
		$this->keywords = $keywords;
	}
}
