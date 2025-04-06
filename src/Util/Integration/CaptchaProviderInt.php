<?php

namespace Acomics\Ssr\Util\Integration;

interface CaptchaProviderInt
{

	public function captchaHead(): void;

	public function captcha(string $actionName): void;

}
