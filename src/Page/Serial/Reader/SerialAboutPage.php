<?php

namespace Acomics\Ssr\Page\Serial\Reader;
use Acomics\Ssr\Layout\SerialReaderAside\SerialReaderAsideLayout;
use Acomics\Ssr\Page\PageInt;

class SerialAboutPage extends SerialReaderAsideLayout implements PageInt
{
	function content(): void
	{
		echo '<div>serial about</div>';
	}
}

