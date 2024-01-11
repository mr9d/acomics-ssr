<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderMenu;

use Acomics\Ssr\Layout\Serial\SerialLayoutData;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Common\Component\SubscribeButton\SubscribeButton;
use Acomics\Ssr\Util\UrlUtil;

class ReaderMenu extends AbstractComponent
{
	private SerialLayoutData $serialLayoutData;

	public function __construct(SerialLayoutData $serialLayoutData)
	{
		$this->serialLayoutData = $serialLayoutData;
	}

	public function render(): void
	{
		echo '<section class="serial-reader-menu">';

		$this->renderMenu();

		(new SubscribeButton($this->serialLayoutData->id, $this->serialLayoutData->isSubscribed))->render();

		echo '</section>';
	}

	public function renderMenu(): void
	{
		$listUrl = UrlUtil::makeSerialUrl($this->serialLayoutData->code, 'list' . ($this->serialLayoutData->activeIssueNumber ? '?skip=' . ($this->serialLayoutData->activeIssueNumber - 1) : ''));
?>
		<nav>
			<button class="serial-reader-menu-toggle" aria-label="Показать/скрыть меню комикса"></button>
			<ul>
				<li class="read-menu-item-short">
					<a <?=($this->serialLayoutData->activeMenuItem === 'view-first' ? 'class="active"' : '')?> href="<?=UrlUtil::makeSerialUrl($this->serialLayoutData->code, '1')?>" title="Читать комикс <?=$this->serialLayoutData->name?> с первого выпуска">Начало</a> /
					<a <?=($this->serialLayoutData->activeMenuItem === 'view-last' ? 'class="active"' : '')?> href="<?=UrlUtil::makeSerialUrl($this->serialLayoutData->code, $this->serialLayoutData->issueCount)?>" title="Читать комикс <?=$this->serialLayoutData->name?> с последнего выпуска">конец</a> /
					<a <?=($this->serialLayoutData->activeMenuItem === 'list' ? 'class="active"' : '')?> href="<?=$listUrl?>" title="Смотреть комикс <?=$this->serialLayoutData->name?> лентой">лента</a>
				</li>
				<li class="read-menu-item-full">
					<a <?=($this->serialLayoutData->activeMenuItem === 'view-first' ? 'class="active"' : '')?> href="<?=UrlUtil::makeSerialUrl($this->serialLayoutData->code, '1')?>" title="Читать комикс <?=$this->serialLayoutData->name?> с первого выпуска">Читать с начала</a> /
					<a <?=($this->serialLayoutData->activeMenuItem === 'view-last' ? 'class="active"' : '')?> href="<?=UrlUtil::makeSerialUrl($this->serialLayoutData->code, $this->serialLayoutData->issueCount)?>" title="Читать комикс <?=$this->serialLayoutData->name?> с последнего выпуска">с конца</a> /
					<a <?=($this->serialLayoutData->activeMenuItem === 'list' ? 'class="active"' : '')?> href="<?=$listUrl?>" title="Смотреть комикс <?=$this->serialLayoutData->name?> лентой">лентой</a>
				</li>
				<li <?=($this->serialLayoutData->activeMenuItem === 'about' ? 'class="active"' : '')?>>
					<a href="<?=UrlUtil::makeSerialUrl($this->serialLayoutData->code, 'about')?>" title="О комиксе <?=$this->serialLayoutData->name?> читать">О комиксе</a>
				</li>
				<li <?=($this->serialLayoutData->activeMenuItem === 'content' ? 'class="active"' : '')?>>
					<a href="<?=UrlUtil::makeSerialUrl($this->serialLayoutData->code, 'content')?>" title="Содержание комикса <?=$this->serialLayoutData->name?> на сайте Авторский Комикс">Содержание</a>
				</li>
				<li <?=($this->serialLayoutData->activeMenuItem === 'comment' ? 'class="active"' : '')?>>
					<a href="<?=UrlUtil::makeSerialUrl($this->serialLayoutData->code, 'comment')?>" title="Комментарии к комиксу <?=$this->serialLayoutData->name?>">Комментарии</a>
				</li>
<?php
				if ($this->serialLayoutData->isCharacterMenuItemVisible)
				{
					$this->renderCharacterMenuItem();
				}
				if ($this->serialLayoutData->isFaqMenuItemVisible)
				{
					$this->renderFaqMenuItem();
				}
?>
				<li class="css-menu-item">
					<a href="<?=UrlUtil::makeSerialUrl($this->serialLayoutData->code, 'rss')?>" title="RSS-канал">RSS</a>
				</li>

			</ul>
		</nav>
<?php
	}
	private function renderCharacterMenuItem(): void
	{
?>
		<li <?=($this->serialLayoutData->activeMenuItem === 'character' ? 'class="active"' : '')?>>
			<a href="<?=UrlUtil::makeSerialUrl($this->serialLayoutData->code, 'character')?>" title="Персонажи комикса <?=$this->serialLayoutData->name?>">Персонажи</a>
		</li>
<?php
	}

	private function renderFaqMenuItem(): void
	{
?>
		<li <?=($this->serialLayoutData->activeMenuItem === 'faq' ? 'class="active"' : '')?>>
			<a href="<?=UrlUtil::makeSerialUrl($this->serialLayoutData->code, 'faq')?>" title="FAQ комикса <?=$this->serialLayoutData->name?>">FAQ</a>
		</li>
<?php
	}
}
