<?php

namespace Acomics\Ssr\Layout\Common\Component\LazyContent;

use Acomics\Ssr\Layout\AbstractComponent;

class LazyContent extends AbstractComponent
{
    private string $getContentUrl;
    private int $minHeight;

    public function __construct(string $getContentUrl, int $minHeight)
    {
        $this->getContentUrl = $getContentUrl;
        $this->minHeight = $minHeight;
    }

    public function render(): void
    {
        echo '<div
            class="lazy-content"
            data-get-content-url="' . $this->getContentUrl . '"
            style="min-height: "' . $this->minHeight . 'px"
            ></div>';
    }
}
