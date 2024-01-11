<?php

namespace Acomics\Ssr\Layout\Serial\Component\AboutBadges;

use Acomics\Ssr\Dto\SerialCategoryDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Util\CatalogStatus;

class AboutBadges extends AbstractComponent {
	private int $catalogStatus;
	private bool $isTranslation;
	private bool $isCompleted;
	/** @var SerialCategoryDto[] $categories */
	private array $categories;

	/** @param SerialCategoryDto[] $categories */
	public function __construct(int $catalogStatus, bool $isTranslation, bool $isCompleted, array $categories)
	{
		$this->catalogStatus = $catalogStatus;
		$this->isTranslation = $isTranslation;
		$this->isCompleted = $isCompleted;
		$this->categories = $categories;
	}

	public function render(): void
	{
		echo '<p class="serial-about-badges">';

		$this->renderTranslationBadge();

		$this->renderCategoryBadges();

		$this->renderCatalogBadge();

		$this->renderCompletedBadge();

		echo '</p>'; // serial-about-badges
	}

	private function renderTranslationBadge(): void
	{
		if (!$this->isTranslation)
		{
			return;
		}

		echo '<a class="badge translation" href="/comics?type=trans">Перевод</a>';
	}

	private function renderCompletedBadge(): void
	{
		if (!$this->isCompleted)
		{
			return;
		}

		echo '<span class="badge completed">Завершен</span>';
	}

	private function renderCategoryBadges(): void
	{
		foreach ($this->categories as $category) {
			echo '<a class="badge category category-' . $category->code . '" href="/comics/' . $category->code . '">' . $category->name . '</a>';
		}
	}

	private function renderCatalogBadge(): void
	{
		switch ($this->catalogStatus)
		{
			case CatalogStatus::SANDBOX:
				echo '<a class="badge sandbox" href="/sandbox">Песочница</a>';
				break;
			case CatalogStatus::FEATURED:
				echo '<a class="badge featured" href="/featured">Рекомендуем</a>';
				break;
		}
	}

}
