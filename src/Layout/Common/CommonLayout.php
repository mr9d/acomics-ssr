<?php

namespace Acomics\Ssr\Layout\Common;

use Acomics\Ssr\Dto\AuthDto;
use Acomics\Ssr\Layout\AbstractLayout;
use Acomics\Ssr\Layout\Common\Component\Footer\Footer;
use Acomics\Ssr\Layout\Common\Component\Header\Header;
use Acomics\Ssr\Util\UrlUtil;

class CommonLayout extends AbstractLayout
{
	private AuthDto $auth;

    public function __construct(string $title, AuthDto $auth)
    {
        parent::__construct($title);
		$this->auth = $auth;
    }

    protected function head(): void
    {
        parent::head();
        echo '<link rel="shortcut icon" href="/favicon.ico?18-11-2023" />';
        echo '<link rel="stylesheet" href="/static/css/normalize.css?18-11-2023" type="text/css" />';
        echo '<link rel="stylesheet" href="' . UrlUtil::makeStaticUrlWithHash('static/bundle/common.css') . '" type="text/css" />';
        echo '<script defer src="' . UrlUtil::makeStaticUrlWithHash('static/bundle/common.js') . '"></script>';
    }

    public function top(): void
    {
		parent::top();

        (new Header($this->auth))->render();

		echo '<div class="page-background">';
		echo '<div class="page-margins">';
		echo '<main class="common-main">';
    }

    public function bottom(): void
    {
		echo '</main>'; // common-main

		(new Footer())->render();

		echo '</div>'; // page-margins
		echo '</div>'; // page-background

		echo '<div class="header-fade"></div>';

		parent::bottom();
    }
}
