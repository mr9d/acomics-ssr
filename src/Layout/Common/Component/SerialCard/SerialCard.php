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
            src: $this->serial->bannerUrl ? $this->serial->bannerUrl : '/static/img/catalog-stub.svg',
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
        $this->translationIcon();
        $this->topVoteIcon();

        echo '</h2>';
    }

    private function featuredIcon(): void
    {
        if ($this->serial->catalogStatus !== CatalogStatus::FEATURED)
        {
            return;
        }

        echo '<span class="icon-featured"></span>';
    }

    private function translationIcon(): void
    {
        if (!$this->serial->isTranslate)
        {
            return;
        }

        echo '<span class="icon-translation"></span>';
    }

    private function topVoteIcon(): void
    {
        if (!$this->serial->isTopEnabled)
        {
            return;
        }

        echo '<a class="icon-top-vote" href="/top/voter?id=' . $this->serial->code . '">';
        echo '</a>';
    }
}
