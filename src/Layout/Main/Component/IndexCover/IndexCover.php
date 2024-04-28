<?php

namespace Acomics\Ssr\Layout\Main\Component\IndexCover;

use Acomics\Ssr\Dto\CoverDto;
use Acomics\Ssr\Layout\AbstractComponent;

class IndexCover extends AbstractComponent
{
    private static bool $isDepsInitialized = false;

	/** @var CoverDto[] */
    private array $covers;

    /**
     * @param CoverDto[] $covers
     */
    public function __construct(
        array $covers
    )
    {
        $this->covers = $covers;
    }

    public static function headDeps(): void
    {
        // Инициализация библиотеки Swiper
        echo '<link rel="stylesheet" href="/static/css/swiper.min.css">';
        echo '<script defer src="/static/js/swiper.min.js"></script>';

        self::$isDepsInitialized = true;
    }

    public function render(): void
    {
        if (self::$isDepsInitialized === false)
        {
            return;
        }

        echo '<div class="index-cover swiper-container">';

        $this->renderElements();
        $this->renderPagination();
        $this->renderHowto();

        echo '</div>'; // index-cover
    }

    private function renderElements(): void
    {
        echo '<div class="swiper-wrapper">';
        foreach($this->covers as $cover)
        {
            echo '<a href="' . $cover->linkUrl . '" title="' . $cover->linkTitle . '" class="cover swiper-slide" style="background-image: url(\'' . $cover->imageUrl . '\')"></a>';
        }
        echo '</div>'; // swiper-wrapper
    }

    private function renderPagination(): void
    {
        if (count($this->covers) === 0)
        {
            return;
        }

        echo '<div class="cover-pagination"></div>';
    }

    private function renderHowto(): void
    {
        echo '<a href="/cover/index" class="howto">Как попасть на обложку?</a>';
    }
}
