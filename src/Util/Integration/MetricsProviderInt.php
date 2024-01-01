<?php

namespace Acomics\Ssr\Util\Integration;

interface MetricsProviderInt {

	public function metricsHead(): void;

	public function metricsBody(): void;

}

