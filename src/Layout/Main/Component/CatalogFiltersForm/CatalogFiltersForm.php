<?php

namespace Acomics\Ssr\Layout\Main\Component\CatalogFiltersForm;

use Acomics\Ssr\Dto\CatalogFiltersDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Util\Ref\SerialAgeRatingProviderInt;
use Acomics\Ssr\Util\Ref\SerialCategoryProviderInt;

class CatalogFiltersForm extends AbstractComponent
{
    private SerialCategoryProviderInt $serialCategoryProvider;
    private SerialAgeRatingProviderInt $serialAgeRatingProvider;
    private CatalogFiltersDto $filters;
    private DescriptionBuilder $descriptionBuilder;

    public function __construct(
        SerialCategoryProviderInt $serialCategoryProvider,
        SerialAgeRatingProviderInt $serialAgeRatingProvider,
        CatalogFiltersDto $filters
    )
    {
        $this->serialCategoryProvider = $serialCategoryProvider;
        $this->serialAgeRatingProvider = $serialAgeRatingProvider;
        $this->filters = $filters;
        $this->descriptionBuilder = new DescriptionBuilder(
            serialCategoryProvider: $serialCategoryProvider,
            serialAgeRatingProvider: $serialAgeRatingProvider,
            filters: $filters,
        );
    }

    public function render(): void
    {
        echo '<form class="catalog-filters-form">';
        $this->renderMobile();
        $this->renderDesktop();
        echo '</form>'; // catalog-filters-form
    }

    private function renderMobile(): void
    {
        echo '<section class="form-mobile">';

        echo '<p>';
        echo $this->descriptionBuilder->buildHtml() . ' ';
        echo '<button class="show-filters-button">Показать фильтры</button>';
        echo '</p>';

        echo '</section>'; // form-mobile
    }

    private function renderDesktop(): void
    {
        echo '<section class="form-desktop">';
        $this->renderCategories();
        $this->renderShortPart();
        $this->renderFullPart();

        echo '<button type="submit" class="form-submit-button">Применить</button>';

        echo '</section>'; // form-desktop
    }

    private function renderCategories(): void
    {
        echo '<fieldset class="categories">';

        foreach($this->serialCategoryProvider->getAll() as $serialCategory)
        {
            $checked = in_array($serialCategory->id, $this->filters->searchCategories);
            echo '<label class="category-' . $serialCategory->code . '">';
            echo '<input type="checkbox" name="categories[]" value="' . $serialCategory->id . '" ' . ($checked ? 'checked' : '') . '>';
            echo $serialCategory->name;
            echo '</label>';
        }

        echo '</fieldset>'; // categories
    }

    private function renderShortPart(): void
    {
        echo '<div class="form-short-part">';
        $this->renderAgeRatings();
        echo '</div>'; // form-short-part
    }

    private function renderFullPart(): void
    {
        echo '<div class="form-full-part">';
        $this->renderType();
        $this->renderUpdatable();
        $this->renderSubscribe();
        $this->renderIssues();
        $this->renderSort();
        echo '</div>'; // form-full-part
    }

    private function renderAgeRatings(): void
    {
        echo '<div class="label-with-input">';
        echo '<label>Возрастная категория: (<a href="/rating">?</a>)</label>';

        echo '<fieldset class="age-ratings">';

        foreach($this->serialAgeRatingProvider->getAll() as $serialAgeRating)
        {
            $checked = in_array($serialAgeRating->id, $this->filters->searchRatings);
            echo '<label>';
            echo '<input type="checkbox" name="ratings[]" value="' . $serialAgeRating->id . '" ' . ($checked ? 'checked' : '') . '>';
            echo $serialAgeRating->nameShort;
            echo '</label>';
        }

        echo '</fieldset>'; // age-ratings

        echo '<button class="full-form-toggle"><span class="more">Больше настроек</span><span class="less">Меньше настроек</span></button>';

        echo '</div>'; // label-with-input
    }

    private function renderType(): void
    {
        $typeOptions = [
            ['value' => 'orig', 'label' => 'Оригинальный'],
            ['value' => 'trans', 'label' => 'Перевод'],
            ['value' => '0', 'label' => 'Все'],
        ];

        echo '<div class="label-with-input">';
        echo '<label>Тип комикса:</label>';

        echo '<fieldset class="type">';
        foreach($typeOptions as $typeOption)
        {
            $checked = $typeOption['value'] === $this->filters->searchType;
            echo '<label><input type="radio" name="type" value="' . $typeOption['value'] . '"' . ($checked ? ' checked' : '') . '>' . $typeOption['label'] . '</label>';
        }
        echo '</fieldset>';

        echo '</div>'; // label-with-input
    }

    private function renderUpdatable(): void
    {
        $updatableOptions = [
            ['value' => 'yes', 'label' => 'Завершенный'],
            ['value' => 'no', 'label' => 'Продолжающийся'],
            ['value' => '0', 'label' => 'Все'],
        ];
        echo '<div class="label-with-input">';
        echo '<label>Публикация:</label>';

        echo '<fieldset class="Updatable">';
        foreach($updatableOptions as $updatableOption)
        {
            $checked = $updatableOption['value'] === $this->filters->searchUpdatable;
            echo '<label><input type="radio" name="updatable" value="' . $updatableOption['value'] . '"' . ($checked ? ' checked' : '') . '>' . $updatableOption['label'] . '</label>';
        }
        echo '</fieldset>';

        echo '</div>'; // label-with-input
    }

    private function renderSubscribe(): void
    {
        $subscribeOptions = [
            ['value' => 'yes', 'label' => 'В моей ленте'],
            ['value' => 'no', 'label' => 'Кроме моей ленты'],
            ['value' => '0', 'label' => 'Все'],
        ];

        echo '<div class="label-with-input">';
        echo '<label>Подписка:</label>';

        echo '<fieldset class="subscribe">';
        foreach($subscribeOptions as $subscribeOption)
        {
            $checked = $subscribeOption['value'] === $this->filters->searchSubscribe;
            echo '<label><input type="radio" name="subscribe" value="' . $subscribeOption['value'] . '"' . ($checked ? ' checked' : '') . '>' . $subscribeOption['label'] . '</label>';
        }
        echo '</fieldset>';

        echo '</div>'; // label-with-input
    }

    private function renderIssues(): void
    {
        echo '<div class="label-with-input">';
        echo '<label>Минимум страниц:</label>';
        echo '<span><input type="number" min="0" max="9999" name="issue_count" value="' . $this->filters->searchIssueCount . '"></span>';
        echo '</div>'; // label-with-input
    }

    private function renderSort(): void
    {
        $sortOptions = [
            ['value' => 'last_update', 'label' => 'по дате обновления'],
            ['value' => 'subscr_count', 'label' => 'по количеству подписчиков'],
            ['value' => 'issue_count', 'label' => 'по количеству выпусков'],
            ['value' => 'serial_name', 'label' => 'по алфавиту'],
        ];

        echo '<div class="label-with-input">';
        echo '<label>Сортировка:</label>';

        echo '<span><select size="1" name="sort">';
        foreach($sortOptions as $sortOption)
        {
            $selected = $sortOption['value'] === $this->filters->searchSort;
            echo '<option value="' . $sortOption['value'] . '"' . ($selected ? ' selected="selected"' : '') . '>' . $sortOption['label'] . '</option>';
        }
        echo '</select></span>';

        echo '</div>'; // label-with-input
    }
}
