<?php

namespace Acomics\Ssr\Layout\Main\Component\MainCover;

use Acomics\Ssr\Layout\AbstractComponent;

class MainCover extends AbstractComponent
{
    public function render(): void
    {
        echo '<article class="main-cover">';
        echo 'MainCover';
        echo '</article>'; // main-cover
    }
}
