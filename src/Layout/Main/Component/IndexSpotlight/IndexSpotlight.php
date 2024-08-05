<?php

namespace Acomics\Ssr\Layout\Main\Component\IndexSpotlight;

use Acomics\Ssr\Layout\AbstractComponent;

class IndexSpotlight extends AbstractComponent
{
    public function render(): void
    {
        echo '<div class="index-spotlight">';
        $this->renderTabs();
        $this->renderSections();
        echo '</div>'; // index-spotlight
    }

    public function renderTabs(): void
    {

    }

    public function renderSections(): void
    {
        
    }
}
