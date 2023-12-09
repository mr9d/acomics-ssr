<?php
namespace Acomics\Ssr\Layout\Serial;

use Acomics\Ssr\Dto\SerialLayoutDataDto;
use Acomics\Ssr\Layout\Common\CommonLayout;
use Acomics\Ssr\Layout\Serial\Component\SerialHeader\SerialHeader;
use Acomics\Ssr\Util\UrlUtil;

abstract class SerialLayout extends CommonLayout
{
	protected ?SerialLayoutDataDto $serialLayoutData = null;

	public function serial(SerialLayoutDataDto $serialLayoutData): void
	{
		$this->serialLayoutData = $serialLayoutData;
	}

	public function isReady(): bool
	{
		return $this->serialLayoutData !== null && parent::isReady();
	}

    protected function head(): void
    {
        parent::head();
        echo '<link rel="stylesheet" href="' . UrlUtil::makeStaticUrlWithHash('static/bundle/serial.css') . '" type="text/css" />';
		$this->backgroundStyles();
    }

    public function top(): void
    {
		parent::top();
		(new SerialHeader($this->serialLayoutData))->render();
    }

    public function bottom(): void
    {
		parent::bottom();
    }

	private function backgroundStyles(): void
	{
		if (!$this->serialLayoutData->backgroundUrl)
		{
			return;
		}
		
		echo '<style>div.page-background { ';
		echo 'background-image: url(' . $this->serialLayoutData->backgroundUrl . '); ';

		switch($this->serialLayoutData->backgroundPosition)
		{
			case 1:
				echo 'background-attachment: fixed; background-position:top; background-repeat:repeat-x; ';
				break;
			case 2:
				echo 'background-attachment: fixed; background-position:bottom; background-repeat:repeat-x; ';
				break;
			case 3:
				echo 'background-attachment: fixed; background-position:top left; background-repeat:no-repeat; ';
				break;
			case 4:
				echo 'background-attachment: fixed; background-position:center; background-repeat:no-repeat;';
				break;
			case 5:
				echo 'background-attachment: fixed; background-position:center; background-repeat:repeat-y;';
				break;
			case 6:
				echo 'background-size: cover; background-attachment: fixed; background-position:center; background-repeat:no-repeat;';
				break;
			default:
				echo 'background-attachment: scroll; background-position:top; background-repeat:repeat; ';
		}

		echo '}</style>';
	}
}
