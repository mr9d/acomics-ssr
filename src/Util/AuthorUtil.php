<?php

namespace Acomics\Ssr\Util;

use Acomics\Ssr\Dto\SerialCoauthorDto;
use Acomics\Ssr\Dto\SerialDto;

class AuthorUtil
{
	public static function makeAuthorsString(SerialDto $serial): string
	{
		$result = '';

		if($serial->isTranslation)
		{
			if(count($serial->coauthors) > 1)
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
			if(count($serial->coauthors) > 1)
			{
				$result .= '<b>Авторы:</b> ';
			}
			else
			{
				$result .= '<b>Автор:</b> ';
			}
		}

		$coauthorToString = fn(SerialCoauthorDto $coauthor) => '<a href="' . UrlUtil::makeProfileUrl($coauthor->username) . '">' . $coauthor->username . '</a>' . ($coauthor->role ? ' (' . $coauthor->role . ')' : '');

		$result .= implode(', ', array_map($coauthorToString, $serial->coauthors));

		return $result;
	}
}
