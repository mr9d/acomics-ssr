<?php
namespace Acomics\Ssr\Layout\Serial;

class SerialLayoutData
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

	//
	// Меню
	//
	public bool $isSubscribed;
	public bool $isCharacterMenuItemVisible;
	public bool $isFaqMenuItemVisible;
	public ?string $activeMenuItem;
	public ?int $activeIssueNumber;
	public int $issueCount;

}
