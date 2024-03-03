<?php

namespace Acomics\Ssr\Layout\Common\Component\SerialCard;

use Acomics\Ssr\Dto\CatalogSerialDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Util\UrlUtil;


class SerialCard extends AbstractComponent
{
    private CatalogSerialDto $serial;

    public function __construct(CatalogSerialDto $serial)
    {
        $this->serial = $serial;
    }

    public function render(): void
    {
        echo '<article class="serial-card">';

        echo UrlUtil::makeSerialUrl($this->serial->code);

        echo '</article>'; // serial-card
    }
}
