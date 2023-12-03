<?php

namespace Acomics\Ssr\Layout\Common\Component\UserMenuModal;

use Acomics\Ssr\Dto\AuthDto;
use Acomics\Ssr\Dto\LinkDto;
use Acomics\Ssr\Layout\Common\Component\HeaderModal\HeaderModal;
use Acomics\Ssr\Util\UrlUtil;

class UserMenuModal extends HeaderModal
{
	private AuthDto $auth;

	public function __construct(AuthDto $auth)
	{
		parent::__construct('user-menu');
		$this->auth = $auth;
	}

	public function renderContent(): void
	{
		echo '<nav>';
		if ($this->auth->isLoggedIn)
		{
			$this->renderLoggedInContent();
		}
		else
		{
			$this->renderGuestContent();
		}
		echo '</nav>';
	}

	private function renderGuestContent(): void
	{
?>
		<p>Войдите или <a href="/auth/reg">зарегистрируйтесь</a>.</p>

		<form method="POST" action="/action/authLogin">
			<label for="username">Имя пользователя:</label>
			<input name="username" type="text" class="text" />
			<label for="password">Пароль:</label>
			<input name="password" type="password" class="text" />
			<input name="check" type="hidden" value="0" />
			<input name="referer" type="hidden" value="" />
			<span class="forget"><a href="/auth/passwordRecovery">Забыли пароль?</a></span>
			<button name="submit" type="submit" class="submit" value="login">Войти</button>
		</form>
<?php
	}

	private function renderLoggedInContent(): void
	{
?>
		<p>Ваш логин: <b><?=$this->auth->username?></b></p>

		<ul>
			<li><a href="/msg/inbox">Личные сообщения<?=($this->auth->messagesCount ? ' [' . $this->auth->messagesCount . ']' : '')?></a></li>
			<li><a href="<?=UrlUtil::makeProfileUrl($this->auth)?>">Профиль</a></li>
			<li><a href="/settings/profile">Настройки профиля</a></li>
<?php
			foreach($this->auth->extraUserMenuLinks as $extraLink)
			{
				$this->renderExtraLink($extraLink);
			}
?>
			<li><a href="/auth/logout">Выход</a></li>
		</ul>
<?php
	}

	private function renderExtraLink(LinkDto $extraLink): void
	{
		echo '<li><a href="' . $extraLink->url . '">' . $extraLink->caption . '</a></li>';
	}
}
