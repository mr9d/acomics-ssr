<?php

namespace Acomics\Ssr\Util\Integration;

interface VkWidgetProviderInt
{
	public function vkInit(): void;
	
	public function vkLike(): void;
}
