<?php

namespace Acomics\Ssr\Util\Integration;

interface AdvertisementProviderInt
{

	public function advertisementHead(): void;

	public function advertisementFullSidebar(): void;

	public function advertisementSerialViewSidebar(): void;

	public function advertisementMobileTop(): void;

	public function advertisementInfiniteScroll(string $uid): void;

}
