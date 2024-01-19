<?php

namespace Acomics\Ssr\Layout\Common\Component\Paginator;

use Acomics\Ssr\Dto\PaginatorDto;
use Acomics\Ssr\Layout\AbstractComponent;

class Paginator extends AbstractComponent
{
    private const PAGE_JUMP_RANGE = 3;
    private int $pagesTotal;
    private int $currentPage;
    private int $pageSize;
    private string $pageComplement;

    public function __construct(PaginatorDto $dto, string $pageComplement)
    {
        $this->pagesTotal = ceil($dto->total / $dto->pageSize);
        $this->currentPage = floor($dto->skip / $dto->pageSize) + 1;
        $this->pageSize = $dto->pageSize;
        $this->pageComplement = $pageComplement;
    }

    public function render(): void
    {
        if ($this->pagesTotal < 2)
        {
            return;
        }

        echo '<nav class="common-paginator" data-page-size="' . $this->pageSize . '" data-page-complement="' . $this->pageComplement . '"><ul>';

        // Ссылка на первую страницу
        if ($this->currentPage > 1)
        {
            $this->renderLink(1);
        }

        // Многоточие
        if ($this->currentPage > self::PAGE_JUMP_RANGE + 2)
        {
            $this->renderSpacer();
        }

        // Ссылки на предыдущие страницы
        $this->renderLinksRange(max(2, $this->currentPage - self::PAGE_JUMP_RANGE), $this->currentPage - 1);

        // Обозначение текущей страницы
        $this->renderCurrent();

        // Ссылки на следующие страницы
        $this->renderLinksRange($this->currentPage + 1, min($this->pagesTotal - 1, $this->currentPage + self::PAGE_JUMP_RANGE));

        // Многоточие
        if ($this->currentPage < $this->pagesTotal - self::PAGE_JUMP_RANGE - 1)
        {
            $this->renderSpacer();
        }

        // Ссылка на последнюю страницу
        if ($this->currentPage < $this->pagesTotal)
        {
            $this->renderLink($this->pagesTotal);
        }

        echo '</ul></nav>';
    }

    private function renderCurrent(): void
    {
        echo '<li class="current"><span>' . $this->currentPage . '</span></li>';
    }

    private function renderSpacer(): void
    {
        echo '<li class="spacer"><span>...</span></li>';
    }

    private function renderLink(int $pageNumber): void
    {
        echo '<li class="link"><a href="?skip=' . (($pageNumber - 1) * $this->pageSize) . '"><span>' . $pageNumber . '</span></a></li>';
    }

    private function renderLinksRange(int $from, int $to): void
    {
        for($pageNumber = $from; $pageNumber <= $to; $pageNumber++)
        {
            $this->renderLink($pageNumber);
        }
    }
}
