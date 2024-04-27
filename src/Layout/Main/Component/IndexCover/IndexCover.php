<?php

namespace Acomics\Ssr\Layout\Main\Component\IndexCover;

use Acomics\Ssr\Layout\AbstractComponent;

class IndexCover extends AbstractComponent
{
    public function render(): void
    {
        echo '<div class="index-cover">';
        echo 'IndexCover';
        echo '</div>'; // index-cover
    }
}
