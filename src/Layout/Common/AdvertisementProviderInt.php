<?php

namespace Acomics\Ssr\Layout\Common;

interface AdvertisementProviderInt {

	public function head(): void;

	public function renderFullSidebar(): void;

	public function renderSerialViewSidebar(): void;

	public function renderMobileTop(): void;

}
