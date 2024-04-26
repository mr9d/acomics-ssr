<?php

namespace Acomics\Ssr\Layout\Main\Component\SpotlightSerialCard;

use Acomics\Ssr\Layout\AbstractComponent;

class SpotlightSerialCard extends AbstractComponent
{
    public function render(): void
    {
        echo '<article class="spotlight-serial-card">';
        echo 'SpotlightSerialCard';
        echo '</article>'; // spotlight-serial-card
    }
}
