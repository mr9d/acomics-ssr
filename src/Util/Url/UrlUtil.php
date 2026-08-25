<?php

namespace Acomics\Ssr\Util\Url;

use Acomics\Ssr\Layout\Common\AuthData;

require_once __DIR__ . '/../../hashes.generated.php';

class UrlUtil
{
	public const PROFILE_URL_PREFIX = '-';

	public const SERIAL_URL_PREFIX = '~';

	private const DEFAULT_SUBSCRIPTIONS_URL = '/profile/featured';

	public static function makeProfileUrl(string $username, ?string $subPage = null): AcomicsUrl
	{
		return new AcomicsUrl('/' . self::PROFILE_URL_PREFIX . $username . ($subPage ? '/' . $subPage : ''));
	}

	public static function makeSerialUrl(string $serialCode, ?string $subPage = null): AcomicsUrl
	{
		return new AcomicsUrl('/' . self::SERIAL_URL_PREFIX . $serialCode . ($subPage ? '/' . $subPage : ''));
	}

	public static function makeSubscriptionsUrl(AuthData $auth): AcomicsUrl
	{
		if (!$auth->isLoggedIn)
		{
			return new AcomicsUrl(self::DEFAULT_SUBSCRIPTIONS_URL);
		}
		else
		{
			return self::makeProfileUrl($auth->username, 'list2');
		}
	}

	public static function makeStaticUrlWithHash(string $staticPath): AcomicsUrl
	{
		global $hashes;
		return new AcomicsUrl('/' . $staticPath . '?' . $hashes[$staticPath]);
	}
}
