<?php

namespace Acomics\Ssr\Layout\Common\Component\MainMenuModal;

use Acomics\Ssr\Layout\Common\AuthData;
use Acomics\Ssr\Layout\Common\Component\HeaderModal\HeaderModal;
use Acomics\Ssr\Util\UrlUtil;

class MainMenuModal extends HeaderModal
{
	private AuthData $auth;
	private ?string $activePage;

	public function __construct(AuthData $auth, ?string $activePage = null)
	{
		parent::__construct('main-menu');
		$this->auth = $auth;
		$this->activePage = $activePage;
	}

	public function renderContent(): void
	{
?>
		<nav>
			<ul>
				<li>
					<a href="/" class="common-menu-item<?=($this->activePage==='')?' selected':''?>">Главная<span></span></a>
				</li>
				<li>
					<a href="/comics" class="common-menu-item<?=($this->activePage==='comics')?' selected':''?>">Каталог комиксов<span></span></a>
				</li>
				<li>
					<a href="<?=UrlUtil::makeSubscriptionsUrl($this->auth)?>" class="common-menu-item<?=($this->activePage==='list2')?' selected':''?>">Подписки<span></span></a>
				</li>
				<li>
					<a href="/top" class="common-menu-item<?=($this->activePage==='top')?' selected':''?>">Голосовалка<span></span></a>
				</li>
				<li>
					<a href="/live" class="common-menu-item<?=($this->activePage==='live')?' selected':''?>">Прямой эфир<span></span></a>
				</li>
			</ul>
			<ul>
				<li>
					<a href="https://mr9d.github.io/acomicsapi/" class="common-menu-item ext" target="_blank">API<span></span></a>
				</li>
				<li>
					<a href="https://vk.com/acomics" class="common-menu-item ext" target="_blank">Группа VK<span></span></a>
				</li>
				<li>
					<a href="https://boosty.to/acomics" class="common-menu-item ext" target="_blank">Boosty<span></span></a>
				</li>
			</ul>
		</nav>
<?php
	}
}
