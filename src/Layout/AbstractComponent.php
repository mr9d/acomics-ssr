<?php

namespace Acomics\Ssr\Layout;

abstract class AbstractComponent implements ComponentInt
{
    public abstract function render(): void;
}
