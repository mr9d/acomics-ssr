<?php

namespace Acomics\Ssr\Layout\Common\Component\InfiniteScroll;

use Acomics\Ssr\Layout\AbstractComponent;

class InfiniteScroll extends AbstractComponent
{
    public const CONTENT_CLASS = 'infinite-scroll-content';

    public string $url;

    public int $maxLoads;

    public function __construct(
        string $url,
        int $maxLoads,
    )
    {
        $this->url = $url;
        $this->maxLoads = $maxLoads;
    }

    public function render(): void
    {
        echo '<a href="' . $this->url . '" class="infinite-scroll" data-max-loads="' . $this->maxLoads . '">Показать еще</a>';
    }
}
