<?php

namespace Acomics\Ssr\Layout\Main\Component\IndexFeatured;

use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Main\Component\FeaturedSerialCard\FeaturedSerialCard;

class IndexFeatured extends AbstractComponent
{
    public function render(): void
    {
        echo '<div class="index-featured">';
        (new FeaturedSerialCard())->render();
        (new FeaturedSerialCard())->render();
        echo '</div>'; // index-featured
    }
}
