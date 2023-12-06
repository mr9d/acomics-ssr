<?php

namespace Acomics\Ssr\Layout\Serial\Component\ManagerMenu;

use Acomics\Ssr\Dto\SerialLayoutDataDto;
use Acomics\Ssr\Layout\AbstractComponent;

class ManagerMenu extends AbstractComponent
{
	private SerialLayoutDataDto $serialLayoutData;

	public function __construct(SerialLayoutDataDto $serialLayoutData)
	{
		$this->serialLayoutData = $serialLayoutData;
	}

	public function render(): void
	{
		echo '<div>serial manager menu</div>';
	}
}
