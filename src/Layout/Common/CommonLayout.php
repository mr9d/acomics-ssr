<?php

namespace Acomics\Ssr\Layout\Common;

use Acomics\Ssr\Layout\AbstractLayout;
use Acomics\Ssr\Layout\Common\Component\Footer\Footer;
use Acomics\Ssr\Layout\Common\Component\Header\Header;
use Acomics\Ssr\Layout\Common\Component\PageHint\PageHint;
use Acomics\Ssr\Util\Integration\IntegrationsProviderInt;
use Acomics\Ssr\Util\UrlUtil;

abstract class CommonLayout extends AbstractLayout
{
	protected ?AuthData $auth = null;

	protected ?IntegrationsProviderInt $integrationsProvider = null;

	protected ?string $activePage = null;

	private ?PageHintData $hintData = null;

	public function common(
		AuthData $auth,
		IntegrationsProviderInt $integrationsProvider,
		?string $activePage = null): void
	{
		$this->auth = $auth;
		$this->integrationsProvider = $integrationsProvider;
		$this->activePage = $activePage;
	}

	public function hint(PageHintData $hintData): void
	{
		$this->hintData = $hintData;
	}

	public function isReady(): bool
	{
		return $this->auth !== null
			&& $this->integrationsProvider !== null
			&& parent::isReady();
	}

	protected function head(): void
	{
		parent::head();

		$this->integrationsProvider->advertisementHead();
		$this->integrationsProvider->metricsHead();
		$this->integrationsProvider->captchaHead();

		echo '<link rel="shortcut icon" href="/favicon.ico?18-11-2023" />';
		echo '<link rel="stylesheet" href="/static/css/normalize.css?18-11-2023" type="text/css" />';
		echo '<link rel="stylesheet" href="' . UrlUtil::makeStaticUrlWithHash('static/bundle/common.css') . '" type="text/css" />';
		echo '<script defer src="' . UrlUtil::makeStaticUrlWithHash('static/bundle/common.js') . '"></script>';
	}

	public function top(): void
	{
		parent::top();

		$this->integrationsProvider->metricsBody();

		(new Header($this->auth, $this->activePage))->render();

		echo '<div class="page-background">';

		if ($this->hintData !== null)
		{
			(new PageHint($this->hintData))->render();
		}

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
