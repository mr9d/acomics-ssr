<?php

namespace Acomics\Ssr\Util\Ref;

use Acomics\Ssr\Dto\SerialAgeRatingDto;

interface SerialAgeRatingProviderInt
{
	public function getById(int $id): ?SerialAgeRatingDto;

	/** @return SerialAgeRatingDto[] */
	public function getAll(): array;
}
