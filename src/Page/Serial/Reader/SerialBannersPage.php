<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Layout\Common\Component\LazyImage\LazyImage;
use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\SerialReaderAside\SerialReaderAsideLayout;
use Acomics\Ssr\Page\PageInt;

class SerialBannersPage extends SerialReaderAsideLayout implements PageInt
{
	protected ?SerialBannersPageData $pageData = null;

	public function pageData(SerialBannersPageData $pageData): void
	{
		$this->pageData = $pageData;
	}

	public function isReady(): bool
	{
		return $this->pageData !== null && parent::isReady();
	}

    public function content(): void
    {
		(new PageHeaderWithMenu('Баннеры'))->render();

        echo '<section class="serial-banners-list">';

        if (count($this->pageData->banners) === 0)
        {
            echo '<p>Для комикса пока не загружено ни одного баннера.</p>';
        }
        else
        {
            $currentType = null;

            foreach($this->pageData->banners as $banner)
            {
                $type = $banner->width . 'x' . $banner->height;

                if ($type !== $currentType)
                {
                    echo '<h2>' . $type . '</h2>';
                    $currentType = $type;
                }

                echo '<p>';

                (new LazyImage(
                    src: $banner->url,
                    stubSrc: '/static/img/tail-spin.svg',
                    width: $banner->width,
                    height: $banner->height,
                    alt: 'Баннер ' . $type . ' комикса ' . $this->serialLayoutData->name,
                ))->render();

                echo '</p>';
            }
        }

        echo '</section>'; // serial-banners-list
    }
}
