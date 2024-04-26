<?php

namespace Acomics\Ssr\Layout\Main\Component\FeaturedSerialCard;

use Acomics\Ssr\Layout\AbstractComponent;

class FeaturedSerialCard extends AbstractComponent
{
    public function render(): void
    {
        echo '<article class="featured-serial-card">';
        echo 'FeaturedSerialCard';
        echo '</article>'; // featured-serial-card
    }
}
