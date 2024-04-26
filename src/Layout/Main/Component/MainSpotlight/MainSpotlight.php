<?php

namespace Acomics\Ssr\Layout\Main\Component\MainSpotlight;

use Acomics\Ssr\Layout\AbstractComponent;

class MainSpotlight extends AbstractComponent
{
    public function render(): void
    {
        echo '<article class="main-spotlight">';
        echo 'MainSpotlight';
        echo '</article>'; // main-spotlight
    }
}
