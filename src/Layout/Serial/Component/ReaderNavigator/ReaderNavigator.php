<?php

namespace Acomics\Ssr\Layout\Serial\Component\ReaderNavigator;

use Acomics\Ssr\Dto\IssueDto;
use Acomics\Ssr\Dto\SerialDto;
use Acomics\Ssr\Layout\AbstractComponent;

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
?>
		<nav class="reader-navigator">
			<ul>
				<li class="button-content"><a href="" title="Содержание"><span>Содержание</span></a></li>
				<li class="button-first"><a href="" title="Первый выпуск"><span>[[</span></a></li>
				<li class="button-previous"><a href="" title="Предыдущий выпуск"><span>[</span></a></li>
				<li class="button-goto"><a href="" title="Переход к выпуску"><span><?=$this->issue->number?>/<?=$this->serial->issueCount?></span></a></li>
				<li class="button-next"><a href="" title="Следующий выпуск"><span>]</span></a></li>
				<li class="button-last"><a href="" title="Последний выпуск"><span>]]</span></a></li>
				<li class="button-random"><a href="" title="Случайный выпуск"><span>Случайный выпуск</span></a></li>
			</ul>
		</nav>
<?php
	}
}

