<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderIssue;

use Acomics\Ssr\Dto\IssueDto;
use Acomics\Ssr\Dto\SerialDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Common\Component\LazyImage\LazyImage;
use Acomics\Ssr\Util\UrlUtil;

class ReaderIssue extends AbstractComponent
{
	private SerialDto $serial;
	private IssueDto $issue;
	private bool $withNavigation;
	private bool $isLazy;

	public function __construct(
		SerialDto $serial,
		IssueDto $issue,
		bool $withNavigation = true,
		bool $isLazy = false)
	{
		$this->serial = $serial;
		$this->issue = $issue;
		$this->withNavigation = $withNavigation;
		$this->isLazy = $isLazy;
	}
	public function render(): void
	{
		if ($this->withNavigation)
		{
			$this->renderWithNavigation();
		}
		else
		{
			$this->renderWithoutNavigation();
		}
	}

	public function renderWithNavigation(): void
	{
		echo '<section class="reader-issue">';

		if ($this->issue->number < $this->serial->issueCount)
		{
			$this->renderNext();
		}
		else
		{
			$this->renderImage();
		}

		if ($this->issue->number > 1)
		{
			$this->renderPrevious();
		}

		echo '</section>'; // reader-issue
	}

	private function renderWithoutNavigation(): void
	{
		echo '<section class="reader-issue">';

		echo '<a href="' . UrlUtil::makeSerialUrl($this->serial->code, $this->issue->number) . '#title" ' . ($this->issue->alternativeText ? 'title="' . $this->issue->alternativeText . '" ' : '') . 'class="reader-issue-view" aria-label="Переход на страницу выпуска">';
		$this->renderImage();
		echo '</a>';

		echo '</section>'; // reader-issue
	}

	private function renderImage(): void
	{
		$alt = $this->issue->name ? $this->issue->name : 'Комикс ' . $this->serial->name . ': выпуск №' . $this->issue->number;

		(new LazyImage(
			src: $this->issue->url,
			stubSrc: $this->isLazy ? '/static/img/tail-spin.svg' : $this->issue->url,
			width: $this->issue->width,
			height: $this->issue->height,
			alt: $alt,
			class: 'issue',
			otherAttributes: array(
				'title' => $this->issue->alternativeText
			),
		))->render();
	}

	private function renderNext(): void
	{
		echo '<a href="' . UrlUtil::makeSerialUrl($this->serial->code, $this->issue->number + 1) . '#title" ' . ($this->issue->alternativeText ? 'title="' . $this->issue->alternativeText . '" ' : '') . 'class="reader-issue-next" aria-label="Переход к следующему выпуску">';
		$this->renderImage();
		echo '<div class="arrow"></div>';
		echo '</a>';
	}

	private function renderPrevious(): void
	{
		echo '<a href="' . UrlUtil::makeSerialUrl($this->serial->code, $this->issue->number - 1) . '#title" class="reader-issue-previous" aria-label="Переход к предыдущему выпуску">';
		echo '<div class="arrow"></div>';
		echo '</a>';
	}
}
