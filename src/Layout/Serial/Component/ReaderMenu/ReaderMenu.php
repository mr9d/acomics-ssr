<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderMenu;

use Acomics\Ssr\Dto\SerialLayoutDataDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Common\Component\SubscribeButton\SubscribeButton;

class ReaderMenu extends AbstractComponent
{
	private SerialLayoutDataDto $serialLayoutData;

	public function __construct(SerialLayoutDataDto $serialLayoutData)
	{
		$this->serialLayoutData = $serialLayoutData;
	}

	public function render(): void
	{
		echo '<nav class="serial-reader-menu">';

		$this->renderMenu();

		(new SubscribeButton($this->serialLayoutData->id, $this->serialLayoutData->isSubscribed))->render();

		echo '</nav>';
	}

	public function renderMenu(): void
	{
?>
		<ul>
			<li>123</li>
		</ul>
<?php
	}
}
