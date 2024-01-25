<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\SerialBannerDto;

class SerialBannersPageData
{
    /** @var SerialBannerDto $banners */
    public array $banners;

    /** @param SerialBannerDto $banners */
    public function __construct(array $banners)
    {
        $this->banners = $banners;
    }
}
