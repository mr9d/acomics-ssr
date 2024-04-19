<?php

namespace Acomics\Ssr\Layout\Common\Component\SerialCard;

use Acomics\Ssr\Dto\CatalogSerialDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Common\Component\DateTimeFormatted\DateTimeFormatted;
use Acomics\Ssr\Layout\Common\Component\LazyImage\LazyImage;
use Acomics\Ssr\Layout\Common\Component\SubscribeButton\SubscribeButton;
use Acomics\Ssr\Util\CatalogStatus;
use Acomics\Ssr\Util\StringUtil;
use Acomics\Ssr\Util\UrlUtil;


class SerialCard extends AbstractComponent
{
    public const CATALOG_STUB_URL = '/static/img/catalog-stub.svg';
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
        $this->renderAbout();
        $this->renderInfo();
        $this->renderActivity();
        $this->renderSubscribe();

        echo '</article>'; // serial-card
    }

    private function renderBanner(): void
    {
        echo '<a href="' . UrlUtil::makeSerialUrl($this->serial->code) . '" class="cover" title="Читать комикс ' . $this->serial->name . ' онлайн">';

        (new LazyImage(
            src: $this->serial->bannerUrl ? $this->serial->bannerUrl : self::CATALOG_STUB_URL,
            stubSrc: $this->serial->bannerUrl ? '/static/img/tail-spin.svg' : self::CATALOG_STUB_URL,
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

    private function renderAbout(): void
    {
        if ($this->serial->aboutShort === null)
        {
            return;
        }

        echo '<p class="about">' . $this->serial->aboutShort . '</p>';
    }

    private function renderInfo(): void
    {
        echo '<aside class="info">';

        $this->renderAgeRating();
        $this->renderOriginalUrl();
        $this->renderLicense();

        echo '</aside>'; // extra-info
    }

    private function renderAgeRating(): void
    {
        echo '<span class="age-rating">';
        echo 'Рейтинг: <a href="/rating" class="rating' . $this->serial->ageRating->id . '">' . $this->serial->ageRating->nameShort . '</a>';
        echo '</span>'; // rating
    }

    private function renderOriginalUrl(): void
    {
        if (!$this->serial->isTranslate || !$this->serial->siteUrl)
        {
            return;
        }

        echo '<a href="' . $this->serial->siteUrl . '" class="original-url">Оригинал</a>';
    }

    private function renderLicense(): void
    {
        if (!$this->serial->license)
        {
            return;
        }

        echo '<span class="license">';
        echo 'Лицензия: <a href="' . $this->serial->license->descriptionUrl . '">' . $this->serial->license->nameShort . '</a>';
        echo '</span>'; // license
    }

    private function renderActivity(): void
    {
        echo '<section class="activity">';

        $this->renderLastUpdate();
        $this->renderIssueCount();
        $this->renderWeeklyUpdateRate();

        echo '</section>'; // activity
    }

    private function renderLastUpdate(): void
    {
        echo '<p class="last-update">';
        echo 'Последний выпуск: ';

        echo '<a href="' . UrlUtil::makeSerialUrl($this->serial->code, $this->serial->issueCount) . '">';
        (new DateTimeFormatted($this->serial->lastUpdate))->render();
        echo '</a>';

        echo '</p>'; // last-update
    }

    private function renderIssueCount(): void
    {
        echo '<p class="issue-count">';
        echo StringUtil::formatIntCaption($this->serial->issueCount, 'выпуск', 'выпуска', 'выпусков');
        echo '</p>'; // issue-count
    }

    private function renderWeeklyUpdateRate(): void
    {
        if (!$this->serial->isUpdatable)
        {
            echo '<p class="weekly-update-rate closed">&#9632; Закончен</p>';
        }
        else
        {
            $cssClass = $this->serial->weeklyUpdateRate >= 1 ? 'good' : 'bad';
            $rate = $this->serial->weeklyUpdateRate;
            $rateFormatted = $rate == (int)$rate ? $rate : number_format($rate, 3);

            echo '<p class="weekly-update-rate ' . $cssClass . '">&#9658; <b>' . $rateFormatted . '</b> в неделю</p>'; // weekly-update-rate
        }
    }

    private function renderSubscribe(): void
    {
        echo '<section class="subscribe">';

        $this->renderSubscribersCount();
        $this->renderSubscribeButton();

        echo '</section>'; // subscribe
    }

    private function renderSubscribersCount(): void
    {
        echo '<span class="subscribers-count">' . $this->serial->subscrCount . '</span>';
    }

    private function renderSubscribeButton(): void
    {
        (new SubscribeButton($this->serial->id, $this->serial->isSubscribed, SubscribeButton::TYPE_CATALOG))->render();
    }
}
