<?php
namespace Acomics\Ssr\Layout\Common\Component\DateTimeFormatted;

use Acomics\Ssr\Layout\AbstractComponent;

class DateTimeFormatted extends AbstractComponent
{
	private int $dateTimeUnixSeconds;

	public function __construct($dateTimeUnixSeconds)
	{
		$this->dateTimeUnixSeconds = $dateTimeUnixSeconds;
	}

	public function render(): void
	{
		echo '<span class="date-time-formatted">=' . (time() - $this->dateTimeUnixSeconds) . '</span>';
	}
}
