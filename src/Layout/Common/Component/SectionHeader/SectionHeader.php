<?php

namespace Acomics\Ssr\Layout\Common\Component\SectionHeader;

use Acomics\Ssr\Layout\AbstractComponent;

class SectionHeader extends AbstractComponent
{
	private string $header;
    private ?string $id;

    public function __construct(string $header, string $id = null)
    {
        $this->header = $header;
        $this->id = $id;
    }

    public function render(): void
    {
        $idAttribute = $this->id ? ' id="' . $this->id . '"' : '';

        echo '<h2 class="section-header"' . $idAttribute . '>';

        echo '<span class="section-header-line"></span>';
        echo '<span class="section-header-inner">' . $this->header . '</span>';
        echo '<span class="section-header-line"></span>';

        echo '</h2>'; // section-header
    }
}
