<?php

namespace Acomics\Ssr\Layout\Main\Component\CatalogFiltersForm;

use Acomics\Ssr\Dto\CatalogFiltersDto;
use Acomics\Ssr\Service\Dictionary\SerialAgeRatingDictionary;
use Acomics\Ssr\Service\Dictionary\SerialCategoryDictionary;
use Acomics\Ssr\Util\Ref\SerialAgeRatingProviderInt;
use Acomics\Ssr\Util\Ref\SerialCategoryProviderInt;
use Acomics\Ssr\Util\StringUtil;

class DescriptionBuilder
{
    private SerialCategoryProviderInt $serialCategoryProvider;

    private SerialAgeRatingProviderInt $serialAgeRatingProvider;

    private CatalogFiltersDto $filters;

    public function __construct(CatalogFiltersDto $filters)
    {
        $this->serialAgeRatingProvider = SerialAgeRatingDictionary::instance();
        $this->serialCategoryProvider = SerialCategoryDictionary::instance();
        $this->filters = $filters;
    }

    public function buildHtml(): string
    {
        return $this->updatable() .
            $this->type() .
            $this->subscribe() .
            $this->ratings() .
            $this->categories() .
            $this->sort() .
            $this->issueCount() . '.';
    }

    private function updatable(): string
    {
        switch($this->filters->searchUpdatable)
        {
            case 'yes':
                return 'обновляемые ';
            case 'no':
                return 'завершенные ';
            case '0':
            default:
                return '';
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
                return 'комиксы';
        }
    }

    private function subscribe(): string
    {
        switch($this->filters->searchSubscribe)
        {
            case 'yes':
                return ', на которые вы подписаны, ';
            case 'no':
                return ', на которые вы не подписаны, ';
            case '0':
            default:
                return '';
        }
    }

    private function ratings(): string
    {
        if(count($this->filters->searchRatings) === 0)
        {
            // В идеале, это условие никогда не должно выполняться.
            return '';
        }

        if(count($this->filters->searchRatings) === 1)
        {
            $ageRating = $this->serialAgeRatingProvider->getById($this->filters->searchRatings[0]);

            if($ageRating === null)
            {
                return '';
            }

            return ' с возрастным рейтингом ' . $ageRating->nameShort;
        }

        $result = ' с возрастным рейтингом ';

        for($i = 0; $i < count($this->filters->searchRatings); $i++)
        {
            $ageRating = $this->serialAgeRatingProvider->getById($this->filters->searchRatings[$i]);

            if($ageRating === null)
            {
                continue;
            }

            if($i === 0)
            {
                $result .= $ageRating->nameShort;
            }
            else if($i === count($this->filters->searchRatings) - 1)
            {
                $result .= ' или ' . $ageRating->nameShort;
            }
            else
            {
                $result .= ', ' . $ageRating->nameShort;
            }
        }
        return $result;
    }

    private function categories(): string
    {
        if(count($this->filters->searchCategories) === 0)
        {
            return '';
        }

        if(count($this->filters->searchCategories) === 1)
        {
            $serialCategory = $this->serialCategoryProvider->getById($this->filters->searchCategories[0]);

            if($serialCategory === null)
            {
                return '';
            }

            return ' по теме &laquo;' . $serialCategory->name . '&raquo;';
        }

        $result = ' по темам ';

        for($i = 0; $i < count($this->filters->searchCategories); $i++)
        {
            $serialCategory = $this->serialCategoryProvider->getById($this->filters->searchCategories[$i]);

            if($serialCategory === null)
            {
                continue;
            }

            if($i === 0)
            {
                $result .= '&laquo;' . $serialCategory->name . '&raquo;';
            }
            else if($i === count($this->filters->searchCategories) - 1)
            {
                $result .= ' и &laquo;' . $serialCategory->name . '&raquo;';
            }
            else
            {
                $result .= ', &laquo;' . $serialCategory->name . '&raquo;';
            }
        }
        return $result;
    }

    private function sort(): string
    {
        switch($this->filters->searchSort)
        {
            case 'subscr_count':
                return ', отсортированные по числу подписчиков (сначала самые читаемые)';
            case 'issue_count':
                return ', отсортированные по числу выпусков (сначала самые большие)';
            case 'serial_name':
                return ', отсортированные по имени комикса (по алфавиту)';
            case 'last_update':
            default:
                return ', отсортированные по дате обновления (сначала самые свежие)';
        }
    }

    private function issueCount(): string
    {
        if($this->filters->searchIssueCount > 0)
        {
            return ' c минимум ' . StringUtil::formatIntCaption($this->filters->searchIssueCount, 'выпуском', 'выпусками', 'выпусками');
        }
        return '';
    }
}

