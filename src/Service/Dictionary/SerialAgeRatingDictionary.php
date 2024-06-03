<?php

namespace Acomics\Ssr\Service\Dictionary;

use Acomics\Ssr\Dto\SerialAgeRatingDto;
use Acomics\Ssr\Util\Ref\SerialAgeRatingProviderInt;

class SerialAgeRatingDictionary implements SerialAgeRatingProviderInt
{
    public const DEFAULT_AGE_RATING_ID = 1;

	private const AGE_RATING_DICTIONARY = [
        1 => [
            'name' => 'Not Rated (Рейтинг не присвоен)',
            'nameShort' => 'NR',
            'ageRestrict' => 0,
        ],
        2 => [
            'name' => 'General audiences (Для всех возрастов)',
            'nameShort' => 'G',
            'ageRestrict' => 0,
        ],
        3 => [
            'name' => 'Parental guidance suggested (Не рекомендуется лицам до 10 лет)',
            'nameShort' => 'PG',
            'ageRestrict' => 0,
        ],
        4 => [
            'name' => 'Parents strongly cautioned (Не рекомендуется лицам до 13 лет)',
            'nameShort' => 'PG-13',
            'ageRestrict' => 0,
        ],
        5 => [
            'name' => 'Restricted (Не рекомендуется лицам до 17 лет)',
            'nameShort' => 'R',
            'ageRestrict' => 17,
        ],
        6 => [
            'name' => 'No children under 17 (Запрещено лицам до 17 лет)',
            'nameShort' => 'NC-17',
            'ageRestrict' => 18,
        ],
    ];

	private static ?self $singleton = null;

	public static function instance(): SerialAgeRatingDictionary
	{
		if (!(self::$singleton instanceof self)) {
			self::$singleton = new self();
		}
		return self::$singleton;
	}

    public function getById(int $id): ?SerialAgeRatingDto
    {
        if(array_key_exists($id, self::AGE_RATING_DICTIONARY))
		{
			return $this->makeSerialAgeRatingDto($id, self::AGE_RATING_DICTIONARY[$id]);
		}
		return null;
    }

	/** @return SerialAgeRatingDto[] */
	public function getAll(): array
    {
        $result = array();

        foreach(self::AGE_RATING_DICTIONARY as $id => $dictionaryParams)
        {
            $result[$id] = $this->makeSerialAgeRatingDto($id, $dictionaryParams);
        }

        return $result;
    }

    private function makeSerialAgeRatingDto(int $id, array $dictionaryParams): SerialAgeRatingDto
    {
        return new SerialAgeRatingDto(
            id: $id,
            name: $dictionaryParams['name'],
            nameShort: $dictionaryParams['nameShort'],
            iconUrl: null,
            ageRestrict: $dictionaryParams['ageRestrict'],
        );
    }
}
