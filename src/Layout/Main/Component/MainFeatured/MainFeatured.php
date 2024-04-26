<?php

namespace Acomics\Ssr\Layout\Main\Component\MainFeatured;

use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Main\Component\FeaturedSerialCard\FeaturedSerialCard;

class MainFeatured extends AbstractComponent
{
    public function render(): void
    {
        echo '<article class="main-featured">';
        (new FeaturedSerialCard())->render();
        (new FeaturedSerialCard())->render();
        echo '</article>'; // main-featured
    }
}
