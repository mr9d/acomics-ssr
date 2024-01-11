<?php

namespace Acomics\Ssr\Util;

use Acomics\Ssr\Dto\SerialCoauthorDto;

class AuthorUtil
{

	/**
	 * @param SerialCoauthorDto[] $coauthors
	 */
	public static function makeAuthorsString(array $coauthors, bool $isTranslation): string
	{
		$result = '';

		if($isTranslation)
		{
			if(count($coauthors) > 1)
			{
				$result .= '<b>Переводчики:</b> ';
			}
			else
			{
				$result .= '<b>Переводчик:</b> ';
			}
		}
		else
		{
			if(count($coauthors) > 1)
			{
				$result .= '<b>Авторы:</b> ';
			}
			else
			{
				$result .= '<b>Автор:</b> ';
			}
		}

		$coauthorToString = fn(SerialCoauthorDto $coauthor) => '<a href="' . UrlUtil::makeProfileUrl($coauthor->username) . '">' . $coauthor->username . '</a>' . ($coauthor->role ? ' (' . $coauthor->role . ')' : '');

		$result .= implode(', ', array_map($coauthorToString, $coauthors));

		return $result;
	}
}
