<?php

namespace Acomics\Ssr\Layout\Serial\Component\SerialHeader;

use Acomics\Ssr\Dto\SerialLayoutDataDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Util\UrlUtil;

class SerialHeader extends AbstractComponent
{
	private SerialLayoutDataDto $serialLayoutData;

	public function __construct(SerialLayoutDataDto $serialLayoutData)
	{
		$this->serialLayoutData = $serialLayoutData;
	}

	public function render(): void
	{
		echo '<header class="serial-header">';

		if ($this->serialLayoutData->isHeaderManageMenuVisible)
		{
			$this->renderHeaderManageMenu();
		}

		if ($this->serialLayoutData->headerUrl)
		{
			$this->renderHeaderImage();
		}
		else
		{
			$this->renderHeaderName();
		}

		echo '</header>';
	}

	public function renderHeaderManageMenu(): void
	{
?>
		<nav class="serial-manage">
			<ul>
				<li><a href="/manage/addIssue?id=<?=$this->serialLayoutData->id?>">Добавить выпуск</a></li>
				<li><a href="/manage/serial?id=<?=$this->serialLayoutData->id?>">Настройки комикса</a></li>
			</ul>
		</nav>
<?php
	}

	public function renderHeaderImage(): void
	{
?>
		<a class="inner" href="<?=UrlUtil::makeSerialUrl($this->serialLayoutData->code)?>">
			<img class="serial-header-image" src="<?=$this->serialLayoutData->headerUrl?>" alt="<?=$this->serialLayoutData->name?>" />
		</a>
<?php
	}

	public function renderHeaderName(): void
	{
?>
		<a class="inner" href="<?=UrlUtil::makeSerialUrl($this->serialLayoutData->code)?>">
			<span class="serial-header-height">
				<span class="serial-header-name"><?=$this->serialLayoutData->name?></span>
			</span>
		</a>
<?php
	}
}
