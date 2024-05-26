<?php

namespace Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu;

use Acomics\Ssr\Dto\LinkDto;
use Acomics\Ssr\Layout\AbstractComponent;

class PageHeaderWithMenu extends AbstractComponent
{
	private string $header;
	private array $menuItems;

	public function __construct(string $header)
	{
		$this->header = $header;
		$this->menuItems = [];
	}

	public function item(string $url, string $caption, bool $active = false): self
	{
		array_push($this->menuItems, new LinkDto($url, $caption, $active));
		return $this;
	}

	private function renderMenuItem(LinkDto $link)
	{
		echo '<li><a href="' . $link->url . '"' . ($link->active ? ' class="active"' : '') . '>' . $link->caption . '</a></li>';
	}

	function render(): void
	{
		echo '<div class="page-header-with-menu">';
		echo '<h1>' . $this->header . '</h1>';

		if(count($this->menuItems) > 0)
		{
			echo '<nav><ul>';
			foreach($this->menuItems as $menuItem)
			{
				$this->renderMenuItem($menuItem);
			}
			echo '</ul></nav>';
		}

		echo '</div>'; // page-header-with-menu
	}
}
