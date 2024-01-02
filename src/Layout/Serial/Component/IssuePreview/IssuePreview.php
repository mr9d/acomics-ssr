<?php

namespace Acomics\Ssr\Layout\Serial\Component\IssuePreview;

use Acomics\Ssr\Dto\IssuePreviewDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Common\Component\DateTimeFormatted\DateTimeFormatted;
use Acomics\Ssr\Util\UrlUtil;

class IssuePreview extends AbstractComponent
{
	private IssuePreviewDto $issue;

	public function __construct(IssuePreviewDto $issue)
	{
		$this->issue = $issue;
	}

	public function render(): void
	{
		$seriaUrl = UrlUtil::makeSerialUrl($this->issue->serialCode, $this->issue->number);
?>
		<a href="<?=$seriaUrl?>" class="issue-preview">
			<img src="<?=$this->issue->thumbUrl?>" alt="Превью выпуска №<?=$this->issue->number?>" width="200" height="150" />
			<p class="issue-preview-hover">
				<span class="issue-preview-number">Выпуск №<?=$this->issue->number?></span>
				<span class="issue-preview-date"><?php (new DateTimeFormatted($this->issue->postDate))->render(); ?></span>
				<?=($this->issue->name ? '<span class="issue-preview-name">' . $this->issue->name . '</span>' : '')?>
			</p>
		</a>
<?php
	}
}
