<?php

namespace Acomics\Ssr\Service\Dictionary;

use Acomics\Ssr\Dto\SerialCategoryDto;
use Acomics\Ssr\Util\Ref\SerialCategoryProviderInt;

class SerialCategoryDictionary implements SerialCategoryProviderInt
{
	private const CATEGORY_DICTIONARY = [
        1 => [
            'code' => 'animal',
            'name' => 'Животные',
        ],
        2 => [
            'code' => 'drama',
            'name' => 'Драма',
        ],
        3 => [
            'code' => 'fantasy',
            'name' => 'Фентези',
        ],
        4 => [
            'code' => 'gaming',
            'name' => 'Игры',
        ],
        5 => [
            'code' => 'humor',
            'name' => 'Юмор',
        ],
        6 => [
            'code' => 'journal',
            'name' => 'Журнал',
        ],
        7 => [
            'code' => 'paranormal',
            'name' => 'Паранормальное',
        ],
        8 => [
            'code' => 'postapocalypse',
            'name' => 'Конец света',
        ],
        9 => [
            'code' => 'romance',
            'name' => 'Романтика',
        ],
        10 => [
            'code' => 'scifi',
            'name' => 'Фантастика',
        ],
        11 => [
            'code' => 'life',
            'name' => 'Бытовое',
        ],
        12 => [
            'code' => 'steampunk',
            'name' => 'Стимпанк',
        ],
        13 => [
            'code' => 'superheroes',
            'name' => 'Супергерои',
        ],
        14 => [
            'code' => 'detective',
            'name' => 'Детектив',
        ],
        15 => [
            'code' => 'history',
            'name' => 'Историческое',
        ],
    ];

	private static ?self $singleton = null;

	public static function instance(): SerialCategoryDictionary
	{
		if (!(self::$singleton instanceof self)) {
			self::$singleton = new self();
		}
		return self::$singleton;
	}

    public function getById(int $id): ?SerialCategoryDto
    {
        if(array_key_exists($id, self::CATEGORY_DICTIONARY))
		{
			return $this->makeSerialCategoryDto($id, self::CATEGORY_DICTIONARY[$id]);
		}
		return null;
    }

	/** @return SerialCategoryDto[] */
	public function getAll(): array
    {
        $result = array();

        foreach(self::CATEGORY_DICTIONARY as $id => $dictionaryParams)
        {
            $result[$id] = $this->makeSerialCategoryDto($id, $dictionaryParams);
        }

        return $result;
    }

    private function makeSerialCategoryDto(int $id, array $dictionaryParams): SerialCategoryDto
    {
        return new SerialCategoryDto(
            id: $id,
            code: $dictionaryParams['code'],
            name: $dictionaryParams['name'],
        );
    }
}
