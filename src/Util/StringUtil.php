<?php

namespace Acomics\Ssr\Util;

class StringUtil
{
	// Форматирование выражений типа '1 комикс, 2 комикса, 5 комиксов'
	public static function formatIntCaption(int $int, string $str1, string $str2, string $str3): string
	{
		$mod = $int % 10;
		$mod100 = $int % 100;
		if($mod100 > 10 && $mod100 < 20){ return '' . $int . ' ' . $str3; } // 5 комиксов
		if($mod === 0 || $mod > 4){ return '' . $int . ' ' . $str3; } // 5 комиксов
		elseif($mod === 1 ){ return '' . $int . ' ' . $str1; } // 1 комикс
		else{ return '' . $int . ' ' . $str2; } // 2 комикса
	}
}
