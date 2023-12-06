<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderMenu;

use Acomics\Ssr\Dto\SerialLayoutDataDto;
use Acomics\Ssr\Layout\AbstractComponent;

class ReaderMenu extends AbstractComponent
{
	private SerialLayoutDataDto $serialLayoutData;

	public function __construct(SerialLayoutDataDto $serialLayoutData)
	{
		$this->serialLayoutData = $serialLayoutData;
	}

	public function render(): void
	{
		echo '<div>serial reader menu</div>';
	}
}
