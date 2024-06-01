<?php

namespace Acomics\Ssr\Dto;

class SerialLicenseDto
{
    public int $id;
    public string $name;
    public string $nameShort;
    public ?string $iconUrl;
    public ?string $descriptionUrl;

    public function __construct(int $id, string $name, string $nameShort, ?string $iconUrl, ?string $descriptionUrl)
    {
        $this->id = $id;
        $this->name = $name;
        $this->nameShort = $nameShort;
        $this->iconUrl = $iconUrl;
        $this->descriptionUrl = $descriptionUrl;
    }
}
