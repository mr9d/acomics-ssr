<?php
namespace Acomics\Ssr\Dto;

class LinkDto
{
	public string $url;
	public string $caption;
	public bool $active;
	
	public function __construct(string $url, string $caption, bool $active = false)
	{
		$this->url = $url;
		$this->caption = $caption;
		$this->active = $active;
	}
}
