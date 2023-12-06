<?php
namespace Acomics\Ssr\Layout\Serial;

use Acomics\Ssr\Dto\SerialLayoutDataDto;
use Acomics\Ssr\Layout\Common\CommonLayout;
use Acomics\Ssr\Layout\Serial\Component\SerialHeader\SerialHeader;
use Acomics\Ssr\Util\UrlUtil;

class SerialLayout extends CommonLayout
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
}
