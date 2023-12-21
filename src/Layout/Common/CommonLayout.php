<?php

namespace Acomics\Ssr\Layout\Common;

use Acomics\Ssr\Layout\AbstractLayout;
use Acomics\Ssr\Layout\Common\Component\Footer\Footer;
use Acomics\Ssr\Layout\Common\Component\Header\Header;
use Acomics\Ssr\Util\UrlUtil;

abstract class CommonLayout extends AbstractLayout
{
	protected ?AuthData $auth = null;
	protected ?AdvertisementProviderInt $advertisementProvider = null;
	protected ?MetricsProviderInt $metricsProvider = null;
	protected ?string $activePage = null;

	public function common(AuthData $auth, AdvertisementProviderInt $advertisementProvider, MetricsProviderInt $metricsProvider, ?string $activePage = null): void
	{
		$this->auth = $auth;
		$this->advertisementProvider = $advertisementProvider;
		$this->metricsProvider = $metricsProvider;
		$this->activePage = $activePage;
	}

	public function isReady(): bool
	{
		return $this->auth !== null && $this->advertisementProvider !== null && $this->metricsProvider !== null && parent::isReady();
	}

	protected function head(): void
	{
		parent::head();

		$this->advertisementProvider->head();
		$this->metricsProvider->head();

		echo '<link rel="shortcut icon" href="/favicon.ico?18-11-2023" />';
		echo '<link rel="stylesheet" href="/static/css/normalize.css?18-11-2023" type="text/css" />';
		echo '<link rel="stylesheet" href="' . UrlUtil::makeStaticUrlWithHash('static/bundle/common.css') . '" type="text/css" />';
		echo '<script defer src="' . UrlUtil::makeStaticUrlWithHash('static/bundle/common.js') . '"></script>';
	}

	public function top(): void
	{
		parent::top();

		$this->metricsProvider->body();

		(new Header($this->auth, $this->activePage))->render();

		echo '<div class="page-background">';
		echo '<div class="page-margins">';
		echo '<div class="common-content">';
	}

	public function bottom(): void
	{
		echo '</div>'; // common-content

		(new Footer())->render();

		echo '</div>'; // page-margins
		echo '</div>'; // page-background

		echo '<div class="header-fade"></div>';

		parent::bottom();
	}
}
