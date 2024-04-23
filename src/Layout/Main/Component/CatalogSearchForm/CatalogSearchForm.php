<?php

namespace Acomics\Ssr\Layout\Main\Component\CatalogSearchForm;

use Acomics\Ssr\Layout\AbstractComponent;

class CatalogSearchForm extends AbstractComponent
{
    private const SEARCH_MIN_LENGTH = 3;

    private ?string $query;

    public function __construct(?string $query = null)
    {
        $this->query = $query;
    }

    public function render(): void
    {
        echo '<form class="catalog-search-form" method="GET" action="/search">';
		echo '<input type="text" name="keyword" required placeholder="Поиск по каталогу" value="' . ($this->query ? $this->query : '') . '" pattern=".{' . self::SEARCH_MIN_LENGTH . ',}" title="Минимальное количество символов для поиска: ' . self::SEARCH_MIN_LENGTH . '" spellcheck="false" autocomplete="off" autocorrect="off" autocapitalize="off" disabled />';
		echo '<button type="submit" class="submit">Найти</button>';
	    echo '</form>'; // catalog-search-form
    }
}
