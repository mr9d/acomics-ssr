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

	private int $issueNumber;

	public function __construct(SerialDto $serial, IssueDto $issue)
	{
		$this->serial = $serial;
		$this->issue = $issue;
	}

	public function render(): void
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

