<?php

namespace Acomics\Ssr\Layout\Serial\Component\Question;

use Acomics\Ssr\Dto\SerialFaqDto;
use Acomics\Ssr\Layout\ComponentInt;

class Question implements ComponentInt
{
    private SerialFaqDto $faq;

    public function __construct(SerialFaqDto $faq)
    {
        $this->faq = $faq;
    }

    public function render(): void
    {
        echo '<section class="serial-faq">';

        $this->renderQuestion();
        $this->renderAnswer();
        
        echo '</section>'; // serial-faq
    }

    public function renderQuestion(): void
    {
        echo '<h2>' . $this->faq->question . '</h2>';
    }

    public function renderAnswer(): void
    {
        echo $this->faq->answer;
    }
}
