<?php

namespace Acomics\Ssr\Layout\Common;

interface MetricsProviderInt {

	public function head(): void;

	public function body(): void;
	
}

