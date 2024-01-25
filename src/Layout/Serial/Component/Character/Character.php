<?php

namespace Acomics\Ssr\Layout\Serial\Component\Character;

use Acomics\Ssr\Dto\SerialCharacterDto;
use Acomics\Ssr\Layout\Common\Component\LazyImage\LazyImage;
use Acomics\Ssr\Layout\ComponentInt;

class Character implements ComponentInt
{
    private SerialCharacterDto $character;

    public function __construct(SerialCharacterDto $character)
    {
        $this->character = $character;
    }

    public function render(): void
    {
        echo '<section class="serial-character">';

        $this->renderPreview();

        echo '<h2>' . $this->character->name . '</h2>';

        $this->renderAbout();

        echo '</section>'; // serial-character
    }

    private function renderPreview(): void
    {
        if($this->character->imageUrl === null || $this->character->imageUrl === null)
        {
            return;
        }

        echo '<div class="image">';
        echo '<a href="' . $this->character->imageUrl . '">';

        (new LazyImage(
            src: $this->character->thumbUrl,
            stubSrc: '/static/img/tail-spin.svg',
            width: 100,
            height: 100,
            alt: $this->character->name
        ))->render();

        echo '</a>';
        echo '</div>'; // image
    }

    private function renderAbout(): void
    {
        if($this->character->about === null)
        {
            return;
        }

        echo '<div class="about">';
        echo $this->character->about;
        echo '</div>'; // about
    }
}
