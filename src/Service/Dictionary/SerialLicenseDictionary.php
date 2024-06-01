<?php

namespace Acomics\Ssr\Service\Dictionary;

use Acomics\Ssr\Dto\SerialLicenseDto;
use Acomics\Ssr\Util\Ref\SerialLicenseProviderInt;

class SerialLicenseDictionary implements SerialLicenseProviderInt
{
    public const DEFAULT_LICENSE_ID = 1;

	private const LICENSE_DICTIONARY = [
        1 => [
            'name' => 'Нет лицензии или не CC',
            'nameShort' => 'NO',
            'descriptionUrl' => null,
        ],
        2 => [
            'name' => 'Attribution',
            'nameShort' => 'CC BY',
            'descriptionUrl' => 'https://creativecommons.org/licenses/by/4.0/deed.ru',
        ],
        3 => [
            'name' => 'Attribution-ShareAlike',
            'nameShort' => 'CC BY-SA',
            'descriptionUrl' => 'https://creativecommons.org/licenses/by-sa/4.0/deed.ru',
        ],
        4 => [
            'name' => 'Attribution-NoDerivs',
            'nameShort' => 'CC BY-ND',
            'descriptionUrl' => 'https://creativecommons.org/licenses/by-nd/4.0/deed.ru',
        ],
        5 => [
            'name' => 'Attribution-NonCommercial',
            'nameShort' => 'CC BY-NC',
            'descriptionUrl' => 'https://creativecommons.org/licenses/by-nc/4.0/deed.ru',
        ],
        6 => [
            'name' => 'Attribution-NonCommercial-ShareAlike',
            'nameShort' => 'CC BY-NC-SA',
            'descriptionUrl' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/deed.ru',
        ],
        7 => [
            'name' => 'Attribution-NonCommercial-NoDerivs',
            'nameShort' => 'CC BY-NC-ND',
            'descriptionUrl' => 'https://creativecommons.org/licenses/by-nc-nd/4.0/deed.ru',
        ],
    ];

	private static ?self $singleton = null;

	public static function instance(): SerialLicenseDictionary
	{
		if (!(self::$singleton instanceof self)) {
			self::$singleton = new self();
		}
		return self::$singleton;
	}

    public function getById(int $id): ?SerialLicenseDto
    {
        if(array_key_exists($id, self::LICENSE_DICTIONARY))
		{
			return $this->makeSerialLicenseDto($id, self::LICENSE_DICTIONARY[$id]);
		}
		return null;
    }

	/** @return SerialLicenseDto[] */
	public function getAll(): array
    {
        $result = array();

        foreach(self::LICENSE_DICTIONARY as $id => $dictionaryParams)
        {
            $result[$id] = $this->makeSerialLicenseDto($id, $dictionaryParams);
        }

        return $result;
    }

    private function makeSerialLicenseDto(int $id, array $dictionaryParams): SerialLicenseDto
    {
        return new SerialLicenseDto(
            id: $id,
            name: $dictionaryParams['name'],
            nameShort: $dictionaryParams['nameShort'],
            iconUrl: null,
            descriptionUrl: $dictionaryParams['descriptionUrl'],
        );
    }
}
