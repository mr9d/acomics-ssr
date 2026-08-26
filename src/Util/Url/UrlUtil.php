<?php

namespace Acomics\Ssr\Util\Url;

require_once __DIR__ . '/../../hashes.generated.php';

class UrlUtil
{
	private const DEFAULT_ORIGIN = 'https://acomics.ru';

	public const PROFILE_URL_PREFIX = '-';

	public const SERIAL_URL_PREFIX = '~';

	private const DEFAULT_SUBSCRIPTIONS_URL = '/profile/featured';

	public static function getOrigin(): string
	{
		return self::DEFAULT_ORIGIN;
	}

	public static function makeProfileUrl(string $username, ?string $subPage = null): AcomicsUrl
	{
		return new AcomicsUrl('/' . self::PROFILE_URL_PREFIX . $username . ($subPage ? '/' . $subPage : ''), static::getOrigin());
	}

	public static function makeSerialUrl(string $serialCode, ?string $subPage = null): AcomicsUrl
	{
		return new AcomicsUrl('/' . self::SERIAL_URL_PREFIX . $serialCode . ($subPage ? '/' . $subPage : ''), static::getOrigin());
	}

	public static function makeTopVoterUrl(string $serialCode): AcomicsUrl
	{
		return new AcomicsUrl('/top/voter?id=' . $serialCode, static::getOrigin());
	}

	public static function makeSubscriptionsUrl(?string $username, bool $isLoggedIn): AcomicsUrl
	{
		if (!$isLoggedIn)
		{
			return new AcomicsUrl(self::DEFAULT_SUBSCRIPTIONS_URL, static::getOrigin());
		}
		else
		{
			return self::makeProfileUrl($username, 'list2');
		}
	}

	public static function makeStaticUrlWithHash(string $staticPath): AcomicsUrl
	{
		global $hashes;
		return new AcomicsUrl('/' . $staticPath . '?' . $hashes[$staticPath], static::getOrigin());
	}
}
