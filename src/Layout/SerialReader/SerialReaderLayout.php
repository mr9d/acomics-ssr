<?php

namespace Acomics\Ssr\Layout\SerialReader;

use Acomics\Ssr\Layout\Serial\Component\ReaderMenu\ReaderMenu;
use Acomics\Ssr\Layout\Serial\SerialLayout;

class SerialReaderLayout extends SerialLayout
{
    protected function head(): void
    {
        parent::head();
    }

    public function top(): void
    {
		parent::top();
		(new ReaderMenu($this->serialLayoutData))->render();
    }

    public function bottom(): void
    {
		parent::bottom();
    }
}
