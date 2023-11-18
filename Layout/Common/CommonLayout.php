<?php

namespace Acomics\Ssr\Layout\Common;

use Acomics\Ssr\Layout\AbstractLayout;
use Acomics\Ssr\Layout\Common\Component\Footer\Footer;
use Acomics\Ssr\Layout\Common\Component\Header\Header;

class CommonLayout extends AbstractLayout {

    public function __construct(string $title)
    {
        parent::__construct($title);
    }

    protected function head(): void
    {
        parent::head();
        echo '<link rel="shortcut icon" href="/favicon.ico?18-11-2023" />';
        echo '<link rel="stylesheet" href="/static/css/normalize.css?18-11-2023" type="text/css" />';
        echo '<link rel="stylesheet" href="/static/bundle/common.css?18-11-2023" type="text/css" />';
        echo '<script defer src="/static/bundle/common.js?18-11-2023"></script>';
    }

    public function start(): void
    {
        parent::start();
        (new Header())->render();
    }

    public function stop(): void
    {
        (new Footer())->render();
        parent::stop();
    }
}
