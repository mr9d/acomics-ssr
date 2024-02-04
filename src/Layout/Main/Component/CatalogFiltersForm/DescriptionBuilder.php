<?php

namespace Acomics\Ssr\Layout\Main\Component\CatalogFiltersForm;

use Acomics\Ssr\Dto\CatalogFiltersDto;
use Acomics\Ssr\Util\StringUtil;

class DescriptionBuilder
{
    private CatalogFiltersDto $filters;

    public function __construct(CatalogFiltersDto $filters)
    {
        $this->filters = $filters;
    }

    public function buildHtml(): string
    {
        return $this->updatable() .
            ' ' . $this->type() .
            ' ' . $this->subscribe() .
            ' ' . $this->ratings() .
            ' ' . $this->sort() .
            ' ' . $this->issueCount();
    }

    private function updatable(): string
    {
        switch($this->filters->searchUpdatable)
        {
            case 'yes':
                return 'Обновляемые';
            case 'no':
                return 'Завершенные';
            case '0':
            default:
                return 'Все';
        }
    }

    private function type(): string
    {
        switch($this->filters->searchType)
        {
            case 'orig':
                return 'авторские комиксы';
            case 'trans':
                return 'переводные комиксы';
            case '0':
            default:
                return 'переводные и авторские комиксы';
        }
    }

    private function subscribe(): string
    {
        switch($this->filters->searchSubscribe)
        {
            case 'yes':
                return 'из ваших подписок';
            case 'no':
                return 'не из ваших подписок';
            case '0':
            default:
                return '';
        }
    }

    private function ratings(): string
    {
        if(count($this->filters->searchRatings) === 0)
        {
            return '';
        }

        // for($i = 0; $i < count($this->filters->searchRatings); $i++)
        // {

        // }
        return ''; //wip
    }

    private function sort(): string
    {
        switch($this->filters->searchSort)
        {
            case 'subscr_count':
                return 'по числу подписчиков (сначала самые читаемые)';
            case 'issue_count':
                return 'по числу выпусков (сначала самые большие)';
            case 'serial_name':
                return 'по имени комикса (по алфавиту)';
            case 'last_update':
            default:
                return 'по дате обновления (сначала самые свежие)';
        }
    }

    private function issueCount(): string
    {
        if($this->filters->searchIssueCount > 0)
        {
            return '(минимум ' . StringUtil::formatIntCaption($this->filters->searchIssueCount, 'выпуск', 'выпуска', 'выпусков') . ')';
        }
        return '';
    }
}

