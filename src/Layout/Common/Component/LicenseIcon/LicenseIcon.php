<?php

namespace Acomics\Ssr\Layout\Common\Component\LicenseIcon;

use Acomics\Ssr\Dto\SerialLicenseDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Service\Dictionary\SerialLicenseDictionary;

class LicenseIcon extends AbstractComponent
{
    private const ICONS = [
        2 => ['cc', 'by'],
        3 => ['cc', 'by', 'sa'],
        4 => ['cc', 'by', 'nd'],
        5 => ['cc', 'by', 'nc'],
        6 => ['cc', 'by', 'nc', 'sa'],
        7 => ['cc', 'by', 'nc', 'nd'],
    ];

    private SerialLicenseDto $license;

    public function __construct(int $licenseId)
    {
        $this->license = SerialLicenseDictionary::instance()->getById($licenseId);
    }

    public function render(): void
    {
        echo '<a class="license-icon" href="' . $this->license->descriptionUrl . '" title="' . $this->license->name . '">';

        foreach (self::ICONS[$this->license->id] as $icon)
        {
            echo '<span class="license-icon-part-' . $icon . '"></span>';
        }

        echo '</a>'; // license-icon
    }
}
