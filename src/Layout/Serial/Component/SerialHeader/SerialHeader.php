<?php

namespace Acomics\Ssr\Layout\Serial\Component\SerialHeader;

use Acomics\Ssr\Dto\SerialLayoutDataDto;
use Acomics\Ssr\Layout\AbstractComponent;

class SerialHeader extends AbstractComponent
{
	private SerialLayoutDataDto $serialLayoutData;

	public function __construct(SerialLayoutDataDto $serialLayoutData)
	{
		$this->serialLayoutData = $serialLayoutData;
	}

	public function render(): void
	{
		echo '<div>serial header</div>';
	}
}
