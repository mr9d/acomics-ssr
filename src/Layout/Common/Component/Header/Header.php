<?php

namespace Acomics\Ssr\Layout\Common\Component\Header;

use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Dto\AuthDto;
use Acomics\Ssr\Layout\Common\Component\MainMenuModal\MainMenuModal;
use Acomics\Ssr\Layout\Common\Component\UserMenuModal\UserMenuModal;
use Acomics\Ssr\Util\UrlUtil;

class Header extends AbstractComponent
{
	private AuthDto $auth;
	private ?string $activePage;

	public function __construct(AuthDto $auth, ?string $activePage = null)
	{
		$this->auth = $auth;
		$this->activePage = $activePage;
	}

    public function render(): void
    {
?>
        <div class="common-header-background">
			<div class="common-header-background-clip"></div>
		</div>

		<header class="common-header">

			<button class="toggle-main-menu"><span></span></button>

			<nav class="common-menu">
				<ul>
					<li>
						<a href="/" title="Авторский Комикс: публикация комиксов на русском языке" class="common-logo">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" width="52px" height="40px" viewBox="0 0 52 40"><defs><g id="LOGO_AK_1_Layer0_0_FILL"><path fill="#EFA821" stroke="none" d="M 52 20.05Q 52 11.75 46.2 5.9 40.4 0.05 32.2 0.05 23.95 0.05 18.15 5.9 14.65 9.45 13.25 13.9L 0 20 13.25 26.2Q 14.65 30.65 18.15 34.2 23.95 40.05 32.2 40.05 40.4 40.05 46.2 34.2 52 28.3 52 20.05M 44.05 8.05Q 49 13 49 20.05 49 27.05 44.05 32.05 39.15 37 32.2 37 25.2 37 20.25 32.05 18.45 30.2 17.3 28.05 16.3 26.2 15.8 24L 6.85 20 15.8 16Q 16.25 13.9 17.3 12 18.45 9.85 20.25 8.05 25.2 3.05 32.2 3.05 39.15 3.05 44.05 8.05 Z"/><path fill="#D31335" stroke="none" d="M 37.3 13L 34.05 20 37.3 27 41.05 27 37.8 20 41.05 13 37.3 13M 26.5 22.2L 27.8 22.2 29.8 27 33.1 27 27.2 13 21.05 27 24.4 27 26.5 22.2 Z"/></g></defs><g transform="matrix( 1, 0, 0, 1, 0,0) "><g transform="matrix( 1, 0, 0, 1, 0,0) "><use xlink:href="#LOGO_AK_1_Layer0_0_FILL"/></g></g></svg>
							<p class="full">Авторский Комикс</p>
							<p class="short">АКомикс</p>
						</a>
					</li>
					<li>
						<a href="/comics" class="common-menu-item<?=($this->activePage==='comics')?' selected':''?>">Каталог<span></span></a>
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

			<a class="publish-button" href="/manage/index"><span>Публикация</span></a>

			<section class="user">
				<button class="toggle-user-menu">
					<img width="40" height="40" src="<?=$this->auth->avatarUrl?>" alt="Аватар пользователя" <?=($this->auth->messagesCount?'class="hasMessages"':'')?> />
				</button>
				<?=($this->auth->messagesCount?'<a href="/msg/inbox" class="msgCount">' . $this->auth->messagesCount . '</a>':'')?>
			</section>

		</header>
<?php
		(new UserMenuModal($this->auth))->render();
		(new MainMenuModal($this->auth, $this->activePage))->render();
    }
}
