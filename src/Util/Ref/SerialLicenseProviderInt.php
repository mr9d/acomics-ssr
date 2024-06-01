<?php

namespace Acomics\Ssr\Util\Ref;

use Acomics\Ssr\Dto\SerialLicenseDto;

interface SerialLicenseProviderInt
{
	public function getById(int $id): ?SerialLicenseDto;

	/** @return SerialLicenseDto[] */
	public function getAll(): array;
}
