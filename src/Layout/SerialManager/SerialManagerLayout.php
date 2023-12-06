<?php

namespace Acomics\Ssr\Layout\SerialManager;

use Acomics\Ssr\Layout\Serial\Component\ManagerMenu\ManagerMenu;
use Acomics\Ssr\Layout\Serial\SerialLayout;

class SerialManagerLayout extends SerialLayout
{
    protected function head(): void
    {
        parent::head();
    }

    public function top(): void
    {
		parent::top();
		(new ManagerMenu($this->serialLayoutData))->render();
    }

    public function bottom(): void
    {
		parent::bottom();
    }
}
