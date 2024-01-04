<?php

namespace Acomics\Ssr\Layout\Common\Component\PageHint;

use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Common\PageHintData;

class PageHint extends AbstractComponent
{
	private PageHintData $data;

	public function __construct(PageHintData $data)
	{
		$this->data = $data;
	}

	function render(): void
	{
		$class = 'common-page-hint' . ($this->data->type ? ' page-hint-' . $this->data->type : '');

		echo '<section class="' . $class . '" data-close-id="' . $this->data->closeButtonId . '">';

		echo '<div class="inner">';

		echo '<p>' . $this->data->text . '</p>';

		if ($this->data->closeButtonId !== null)
		{
			echo '<button class="page-hint-close" aria-label="Скрыть подсказку"></button>';
		}

		echo '</div>'; // inner

		echo '<div class="angles"></div>';

		echo '</section>'; // common-page-hint
	}
}
