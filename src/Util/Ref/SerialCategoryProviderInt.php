<?php

namespace Acomics\Ssr\Util\Ref;

use Acomics\Ssr\Dto\SerialCategoryDto;

interface SerialCategoryProviderInt
{
	public function getById(int $id): ?SerialCategoryDto;

	/** @return SerialCategoryDto[] */
	public function getAll(): array;
}
