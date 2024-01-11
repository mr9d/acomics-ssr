<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderCommentForm;

use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Common\AuthData;
use Acomics\Ssr\Util\Integration\CaptchaProviderInt;
use Acomics\Ssr\Util\UrlUtil;

class ReaderCommentForm extends AbstractComponent
{
	private int $issueId;
	private AuthData $auth;
	private CaptchaProviderInt $captchaProvider;

	public function __construct(int $issueId, AuthData $auth, CaptchaProviderInt $captchaProvider)
	{
		$this->issueId = $issueId;
		$this->auth = $auth;
		$this->captchaProvider = $captchaProvider;
	}

	public function render(): void
	{
		echo '<form class="reader-comment-form" method="POST" action="/action/serialAddComment" enctype="multipart/form-data">';

		echo '<input name="issueId" type="hidden" value="' . $this->issueId . '">';

		$this->renderAvatar();
		$this->renderInfo();

		echo '<textarea name="postText" type="text" class="comment-text" placeholder="Текст комментария" maxlength="10000"></textarea>';

		if (!$this->auth->isLoggedIn)
		{
			$this->renderCaptcha();
		}

		echo '<section class="comment-submit"><button type="submit" name="submit" class="submit" value="add">Отправить</button></section>';

		echo '</form>'; // reader-comment-form
	}

	private function renderAvatar(): void
	{
		$avatarUrl = ($this->auth->isLoggedIn && $this->auth->avatarUrl !== null) ? $this->auth->avatarUrl : '/static/img/avatar-stub.svg';

		echo '<section class="comment-avatar">';
		echo '<img src="' . $avatarUrl . '" alt="Изображение вашего профиля" width="40" height="40">';
		echo '<div class="comment-tail"></div>';
		echo '</section>'; // comment-avatar
	}

	private function renderInfo(): void
	{
		echo '<section class="comment-info">';

		if ($this->auth->isLoggedIn)
		{
			echo '<a class="comment-username" href="' . UrlUtil::makeProfileUrl($this->auth->username) . '" aria-label="Ваш профиль">' . $this->auth->username . '</a>';
		}
		else
		{
			echo '<span class="comment-username">Anonymous</span>';
			echo '<a class="comment-login-link" href="/auth/login">Войти</a>';
			echo '<a class="comment-reg-link" href="/auth/reg">Зарегистрироваться</a>';
		}

		echo '</section>'; // comment-info
	}

	private function renderCaptcha(): void
	{
		echo '<section class="comment-captcha">';

		$this->captchaProvider->captcha();

		echo '</section>'; // comment-captcha
	}
}
