<?php
namespace Acomics\Ssr\Dto;

class SerialLayoutDataDto
{
	//
	// Идентификаторы комикса
	//
	public int $id;
	public string $name;
	public string $code;

	//
	// Базовые элементы оформления
	//
	public ?string $headerUrl;
	public ?string $backgroundUrl;
	public int $backgroundPosition;
	public bool $isHeaderManageMenuVisible;
}
