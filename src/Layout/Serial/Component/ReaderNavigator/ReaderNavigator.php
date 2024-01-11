<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderNavigator;

use Acomics\Ssr\Dto\IssueDto;
use Acomics\Ssr\Dto\SerialDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Util\UrlUtil;

class ReaderNavigator extends AbstractComponent
{
	private SerialDto $serial;
	private IssueDto $issue;
	private bool $listType;

	public function __construct(SerialDto $serial, IssueDto $issue, bool $listType = false)
	{
		$this->serial = $serial;
		$this->issue = $issue;
		$this->listType = $listType;
	}

	public function render(): void
	{
		if ($this->listType)
		{
			$this->renderListType();
		}
		else
		{
			$this->renderViewType();
		}
	}

	public function renderListType(): void
	{
		echo '<nav class="reader-navigator" data-issue-count="' . $this->serial->issueCount . '" data-list-type="' . ($this->listType ? 1 : 0) . '"><ul>';

		$this->renderButton(
			class: 'button-first',
			url: UrlUtil::makeSerialUrl($this->serial->code, 'list') . '?skip=0',
			title: 'Первый выпуск',
			content: '',
			active: $this->issue->number > 1);
		$this->renderButton(
			class: 'button-list-big-jump',
			url: UrlUtil::makeSerialUrl($this->serial->code, 'list') . '?skip=' . max($this->issue->number - 26, 0),
			title: 'Назад на 25 выпусков',
			content: '-25',
			active: $this->issue->number > 25);
		$this->renderButton(
			class: 'button-list-small-jump',
			url: UrlUtil::makeSerialUrl($this->serial->code, 'list') . '?skip=' . max($this->issue->number - 6, 0),
			title: 'Назад на 5 выпусков',
			content: '-5',
			active: $this->issue->number > 1);
		$this->renderButton(
			class: 'button-goto',
			url: '#',
			title: 'Переход к выпуску',
			content: $this->issue->number . '/' . $this->serial->issueCount,
			active: true);
		$this->renderButton(
			class: 'button-list-small-jump',
			url: UrlUtil::makeSerialUrl($this->serial->code, 'list') . '?skip=' . min($this->issue->number + 4, $this->serial->issueCount - 1),
			title: 'Вперед на 5 выпусков',
			content: '+5',
			active: $this->issue->number < $this->serial->issueCount - 4);
		$this->renderButton(
			class: 'button-list-big-jump',
			url: UrlUtil::makeSerialUrl($this->serial->code, 'list') . '?skip=' . min($this->issue->number + 24, $this->serial->issueCount - 1),
			title: 'Вперед на 25 выпусков',
			content: '+25',
			active: $this->issue->number < $this->serial->issueCount - 24);
		$this->renderButton(
			class: 'button-last',
			url: UrlUtil::makeSerialUrl($this->serial->code, 'list') . '?skip=' . ($this->serial->issueCount - 1),
			title: 'Последний выпуск',
			content: '',
			active: $this->issue->number < $this->serial->issueCount);


		echo '</ul></nav>';
	}

	public function renderViewType(): void
	{
		echo '<nav class="reader-navigator" data-issue-count="' . $this->serial->issueCount . '"><ul>';

		$this->renderButton(
			class: 'button-content',
			url: UrlUtil::makeSerialUrl($this->serial->code, 'content'),
			title: 'Содержание',
			content: 'Содержание');
		$this->renderButton(
			class: 'button-first',
			url: UrlUtil::makeSerialUrl($this->serial->code, 1) . '#title',
			title: 'Первый выпуск',
			content: '',
			active: $this->issue->number > 1);
		$this->renderButton(
			class: 'button-previous',
			url: UrlUtil::makeSerialUrl($this->serial->code, max($this->issue->number - 1, 1)) . '#title',
			title: 'Предыдущий выпуск',
			content: '',
			active: $this->issue->number > 1);
		$this->renderButton(
			class: 'button-goto',
			url: '#',
			title: 'Переход к выпуску',
			content: $this->issue->number . '/' . $this->serial->issueCount,
			active: true);
		$this->renderButton(
			class: 'button-next',
			url: UrlUtil::makeSerialUrl($this->serial->code, min($this->issue->number + 1, $this->serial->issueCount)) . '#title',
			title: 'Следующий выпуск',
			content: '',
			active: $this->issue->number < $this->serial->issueCount);
		$this->renderButton(
			class: 'button-last',
			url: UrlUtil::makeSerialUrl($this->serial->code, $this->serial->issueCount) . '#title',
			title: 'Последний выпуск',
			content: '',
			active: $this->issue->number < $this->serial->issueCount);
		$this->renderButton(
			class: 'button-random',
			url: '#',
			title: 'Случайный выпуск',
			content: 'Случайный выпуск',
			active: true);

		echo '</ul></nav>';
	}

	private function renderButton(string $class, string $url, string $title, string $content, bool $active = true): void
	{
		$classes = $active ? $class : $class . ' button-inactive';
		echo '<li class="' . $classes . '"><a href="' . $url . '" title="' . $title . '"><span>' . $content . '</span></a></li>';
	}
}

