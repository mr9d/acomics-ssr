<?php

namespace Acomics\Ssr\Layout\Serial\Component\IssuePreview;

use Acomics\Ssr\Dto\IssuePreviewDto;
use Acomics\Ssr\Layout\AbstractComponent;
use Acomics\Ssr\Layout\Common\Component\DateTimeFormatted\DateTimeFormatted;
use Acomics\Ssr\Layout\Common\Component\LazyImage\LazyImage;
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
        echo '<a href="' . $seriaUrl . '" class="issue-preview">';

		(new LazyImage(
			src: $this->issue->thumbUrl,
			stubSrc: '/static/img/tail-spin.svg',
			width: 200,
			height: 150,
			alt: 'Превью выпуска №' . $this->issue->number,
		))->render();

        $this->renderHover();

        echo '</a>'; // issue-preview
	}

    private function renderHover(): void
    {
        echo '<p class="issue-preview-hover">';

        echo '<span class="issue-preview-number">Выпуск №' . $this->issue->number . '</span>';

        echo '<span class="issue-preview-date">';
        (new DateTimeFormatted($this->issue->postDate))->render();
        echo '</span>';

        if ($this->issue->name)
        {
            echo '<span class="issue-preview-name">' . $this->issue->name . '</span>';
        }

        echo '</p>'; // issue-preview-hover
    }
}
