<?php

namespace Acomics\Ssr\Util;
use Acomics\Ssr\Dto\AuthDto;

require_once __DIR__ . '/../hashes.generated.php';

class UrlUtil
{
	private const PROFILE_URL_PREFIX = '-';
	private const DEFAULT_SUBSCRIPTIONS_URL = 'profile/featured';

	public static function makeProfileUrl(AuthDto $auth, ?string $subPage = null): string
	{
		return '/' . self::PROFILE_URL_PREFIX . $auth->username . ($subPage ? '/' . $subPage : '');
	}

	public static function makeSubscriptionsUrl(AuthDto $auth): string
	{
		if (!$auth->isLoggedIn)
		{
			return self::DEFAULT_SUBSCRIPTIONS_URL;
		}
		else
		{
			return self::makeProfileUrl($auth, 'list2');
		}
	}

	public static function makeStaticUrlWithHash(string $staticPath): string
	{
		global $hashes;
		return '/' . $staticPath . '?' . $hashes[$staticPath];
	}
}
