<?php

namespace Acomics\Ssr\Dto;

class SerialFaqDto
{
    public string $question;
	public ?string $answer;

    public function __construct(string $question, ?string $answer)
    {
        $this->question = $question;
	    $this->answer = $answer;
    }
}
