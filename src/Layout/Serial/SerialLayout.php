<?php
namespace Acomics\Ssr\Layout\Serial;

use Acomics\Ssr\Layout\Serial\SerialLayoutData;
use Acomics\Ssr\Layout\Common\CommonLayout;
use Acomics\Ssr\Layout\Serial\Component\SerialHeader\SerialHeader;
use Acomics\Ssr\Util\UrlUtil;

abstract class SerialLayout extends CommonLayout
{
	private const DEFAULT_OG_IMAGE_URL = '/design/main/pic/catalog-stub.png?18-07-2014';

	protected ?SerialLayoutData $serialLayoutData = null;

	public function serial(SerialLayoutData $serialLayoutData): void
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
		$this->rss();
        echo '<link rel="stylesheet" href="' . UrlUtil::makeStaticUrlWithHash('static/bundle/serial.css') . '" type="text/css" />';
		echo '<script defer src="' . UrlUtil::makeStaticUrlWithHash('static/bundle/serial.js') . '"></script>';
		$this->backgroundStyles();
    }

	private function rss(): void
	{
		$title = $this->serialLayoutData->name;
		$href = UrlUtil::makeSerialUrl($this->serialLayoutData->code, 'rss');

		echo '<link rel="alternate" type="application/rss+xml" title="' . $title . '" href="' . $href . '" />';
	}

	protected function openGraph(): void
	{
		$ogImage = $this->serialLayoutData->ogImage ? $this->serialLayoutData->ogImage : self::DEFAULT_OG_IMAGE_URL;
?>
		<meta property="og:title" content="<?=$this->serialLayoutData->name?>" />
		<meta property="og:type" content="website" />
		<meta property="og:image" content="<?=$ogImage?>" />
		<meta property="og:image:type" content="image/png" />
		<meta property="og:image:width" content="160" />
		<meta property="og:image:height" content="90" />
		<meta property="og:url" content="<?=UrlUtil::makeSerialUrl($this->serialLayoutData->code)?>" />
		<meta property="og:description" content="<?=($this->serialLayoutData->ogDescription)?>" />
<?php
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
