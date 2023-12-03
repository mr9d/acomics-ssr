<?php
namespace Acomics\Ssr\Layout;

interface LayoutInt
{
	public function isReady(): bool;
    public function top(): void;
    public function bottom(): void;
}
