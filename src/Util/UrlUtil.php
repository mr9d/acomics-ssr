<?php

namespace Acomics\Ssr\Util;

use Acomics\Ssr\Layout\Common\AuthData;

require_once __DIR__ . '/../hashes.generated.php';

class UrlUtil
{
	private const PROFILE_URL_PREFIX = '-';
	private const SERIAL_URL_PREFIX = '~';
	private const DEFAULT_SUBSCRIPTIONS_URL = '/profile/featured';

	public static function makeProfileUrl(string $username, ?string $subPage = null): string
	{
		return '/' . self::PROFILE_URL_PREFIX . $username . ($subPage ? '/' . $subPage : '');
	}

	public static function makeSerialUrl(string $serialCode, ?string $subPage = null): string
	{
		return '/' . self::SERIAL_URL_PREFIX . $serialCode . ($subPage ? '/' . $subPage : '');
	}

	public static function makeSubscriptionsUrl(AuthData $auth): string
	{
		if (!$auth->isLoggedIn)
		{
			return self::DEFAULT_SUBSCRIPTIONS_URL;
		}
		else
		{
			return self::makeProfileUrl($auth->username, 'list2');
		}
	}

    public static function updatePageUrlParameter(string $parameterName, string $parameterValue): string
    {
        $pageUrl = $_SERVER['REQUEST_URI'];
        $url = parse_url($pageUrl);

        if(isset($url['query']))
        {
            parse_str($url['query'], $query);
        }
        else
        {
            $query = array();
        }
        
        $query[$parameterName] = $parameterValue;
        return $url['path'] . '?' . http_build_query($query);
    }

	public static function makeStaticUrlWithHash(string $staticPath): string
	{
		global $hashes;
		return '/' . $staticPath . '?' . $hashes[$staticPath];
	}
}
