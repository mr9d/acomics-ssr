<?php

namespace Acomics\Ssr\Page\Serial\Reader;
use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\SerialReaderAside\SerialReaderAsideLayout;
use Acomics\Ssr\Page\PageInt;

class SerialAboutPage extends SerialReaderAsideLayout implements PageInt
{
	function content(): void
	{
		(new PageHeaderWithMenu($this->serialLayoutData->name))->render();
		echo '<div>Serial about</div>';
	}
}

