<?php

namespace Acomics\Ssr\Util\Integration;

interface VkWidgetProviderInt
{
	public function vkInit(bool $group = false, bool $like = false): void;

	public function vkLike(): void;

	public function vkGroup(): void;
}
