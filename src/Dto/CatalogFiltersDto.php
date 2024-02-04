<?php

namespace Acomics\Ssr\Dto;

class CatalogFiltersDto
{
    /**
     * Список числовых идентификаторов категорий (животные, юмор, паранормальное и т.п.) для поиска.
     *
     * @var int[]
     */
    public array $searchCategories;

    /**
     * Список числовых идентификаторов возрастных рейтингов для поиска.
     *
     * @var int[]
     */
    public array $searchRatings;

    /**
     * Минимальное количество выпусков для поиска.
     */
    public int $searchIssueCount;

    /**
     * Проверка на подписку при поиске комикса (только для зарегистрированных пользователей).
     *
     * Возможные значения:
     * - `'yes'` - только в подписках
     * - `'no'` - только не в подписках
     * - `'0'` - все (не применять фильтр)
     */
    public string $searchSubscribe;

    /**
     * Проверка на обновляемость комикса при поиске.
     *
     * Возможные значения:
     * - `'yes'` - только обновляемые
     * - `'no'` - только не обновляемые (завершенные)
     * - `'0'` - все (не применять фильтр)
     */
    public string $searchUpdatable;

    /**
     * Проверка на тип комикса (оригинал/перевод) при поиске.
     *
     * Возможные значения:
     * - `'orig'` - только оригинальные комиксы
     * - `'trans'` - только переводные комиксы
     * - `'0'` - все (не применять фильтр)
     */
    public string $searchType;

    /**
     * Тип сортировки при поиске.
     *
     * Возможные значения:
     * - `'last_update'` - по дате обновления (сначала самые свежие)
     * - `'subscr_count'` - по числу подписчиков (сначала самые читаемые)
     * - `'issue_count'` - по числу выпусков (сначала самые большие)
     * - `'serial_name'` - по имени комикса (по алфавиту)
     */
    public string $searchSort;

    /**
     * @param int[] $searchCategories
     * @param int[] $searchRatings
     */
    public function __construct(
        array $searchCategories,
        array $searchRatings,
        int $searchIssueCount,
        string $searchSubscribe,
        string $searchUpdatable,
        string $searchType,
        string $searchSort)
    {
        $this->searchCategories = $searchCategories;
        $this->searchRatings = $searchRatings;
        $this->searchIssueCount = $searchIssueCount;
        $this->searchSubscribe = $searchSubscribe;
        $this->searchUpdatable = $searchUpdatable;
        $this->searchType = $searchType;
        $this->searchSort = $searchSort;
    }
}

