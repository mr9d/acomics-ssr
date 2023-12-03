<?php
namespace Acomics\Ssr\Layout;

interface AdvertisementProviderInt {
	public function renderFullSidebar(): void;
	public function renderSerialViewSidebar(): void;
	public function renderMobileTop(): void;
}
