<?php

namespace Acomics\Ssr\Layout\Common\Component\SerialCard;

use Acomics\Ssr\Dto\CatalogSerialDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Common\Component\LazyImage\LazyImage;
use Acomics\Ssr\Util\CatalogStatus;
use Acomics\Ssr\Util\UrlUtil;


class SerialCard extends AbstractComponent
{
    private CatalogSerialDto $serial;

    public function __construct(CatalogSerialDto $serial)
    {
        $this->serial = $serial;
    }

    public function render(): void
    {
        echo '<article class="serial-card">';

        $this->renderBanner();

        $this->renderTitle();

        echo '</article>'; // serial-card
    }

    private function renderBanner(): void
    {
        echo '<a href="' . UrlUtil::makeSerialUrl($this->serial->code) . '" class="cover" title="Читать комикс ' . $this->serial->name . ' онлайн">';

        (new LazyImage(
            src: $this->serial->bannerUrl ? $this->serial->bannerUrl : '/design/main/pic/catalog-stub.png?18-07-2014',
            stubSrc: '/static/img/tail-spin.svg',
            width: 160,
            height: 90,
            alt: 'Обложка комикса ' . $this->serial->name
        ))->render();

        echo '</a>';
    }

    private function renderTitle(): void
    {
        echo '<h2 class="title">';

        echo '<a href="' . UrlUtil::makeSerialUrl($this->serial->code) . '" title="Читать комикс ' . $this->serial->name . ' онлайн">';
        echo $this->serial->name;
        echo '</a>';

        $this->featuredIcon();
        $this->translateIcon();
        $this->topVoteIcon();

        echo '</h2>';
    }

    private function featuredIcon(): void
    {
        if ($this->serial->catalogStatus !== CatalogStatus::FEATURED)
        {
            return;
        }

        echo ''; //todo
    }

    private function translateIcon(): void
    {
        if (!$this->serial->isTranslate)
        {
            return;
        }

        echo ''; //todo
    }

    private function topVoteIcon(): void
    {
        if (!$this->serial->isTopEnabled)
        {
            return;
        }

        echo ''; //todo
    }
}
