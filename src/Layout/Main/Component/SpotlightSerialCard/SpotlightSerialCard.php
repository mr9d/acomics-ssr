<?php

namespace Acomics\Ssr\Layout\Main\Component\SpotlightSerialCard;

use Acomics\Ssr\Dto\SpotlightSerialDto;
use Acomics\Ssr\Layout\AbstractComponent;

class SpotlightSerialCard extends AbstractComponent
{
    private SpotlightSerialDto $serial;

    public function __construct(SpotlightSerialDto $serial)
    {
        $this->serial = $serial;
    }

    public function render(): void
    {
        echo '<article class="spotlight-serial-card">';
        echo 'SpotlightSerialCard';
        echo '</article>'; // spotlight-serial-card
    }
}
