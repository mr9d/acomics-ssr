<?php

namespace Acomics\Ssr\Layout;

class OpenGraphData
{
	public string $title;

	public string $type;

	public string $image;

	public string $imageType;

	public int $imageWidth;

	public int $imageHeight;

	public string $url;

	public string $description;

	public function __construct(string $title, string $type, string $image, string $imageType, int $imageWidth, int $imageHeight, string $url, string $description)
	{
		$this->title = $title;
		$this->type = $type;
		$this->image = $image;
		$this->imageType = $imageType;
		$this->imageWidth = $imageWidth;
		$this->imageHeight = $imageHeight;
		$this->url = $url;
		$this->description = $description;
	}
}
