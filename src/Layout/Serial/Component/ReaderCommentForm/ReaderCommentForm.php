<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderCommentForm;

use Acomics\Ssr\Dto\SerialDto;
use Acomics\Ssr\Layout\AbstractComponent;

class ReaderCommentForm extends AbstractComponent
{
	private SerialDto $serial;

	public function __construct(SerialDto $serial)
	{
		$this->serial = $serial;
	}

	public function render(): void
	{
		echo '<form class="reader-comment-form">';
		echo 'serial comment form';
		echo '</form>'; // reader-comment
	}
}
