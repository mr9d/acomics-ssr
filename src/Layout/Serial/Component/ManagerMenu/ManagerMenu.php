<?php

namespace Acomics\Ssr\Layout\Serial\Component\ManagerMenu;

use Acomics\Ssr\Layout\Serial\SerialLayoutData;
use Acomics\Ssr\Layout\AbstractComponent;

class ManagerMenu extends AbstractComponent
{
	private SerialLayoutData $serialLayoutData;

	public function __construct(SerialLayoutData $serialLayoutData)
	{
		$this->serialLayoutData = $serialLayoutData;
	}

	public function render(): void
	{
		echo '<div>serial manager menu</div>';
	}
}
