<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderListLoadMore;

use Acomics\Ssr\Layout\AbstractComponent;

class ReaderListLoadMore extends AbstractComponent
{
	private int $skip;

	public function __construct(int $skip)
	{
		$this->skip = $skip;
	}

	public function render(): void
	{
		echo '<a href="?skip=' . $this->skip . '" class="reader-list-load-more">Следующие выпуски</a>';
	}
}
