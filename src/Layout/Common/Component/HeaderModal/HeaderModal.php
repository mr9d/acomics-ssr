<?php

namespace Acomics\Ssr\Layout\Common\Component\HeaderModal;

use Acomics\Ssr\Layout\AbstractComponent;

abstract class HeaderModal extends AbstractComponent
{
	private string $uniqueClass;

	public function __construct(string $uniqueClass)
	{
		$this->uniqueClass = $uniqueClass;
	}

	public function render(): void
	{
		echo '<div class="' . $this->uniqueClass . ' header-modal">';
		$this->renderContent();
		echo '</div>';
	}

	public abstract function renderContent(): void;

}
