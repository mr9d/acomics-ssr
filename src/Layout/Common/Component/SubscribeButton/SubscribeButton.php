<?php
namespace Acomics\Ssr\Layout\Common\Component\SubscribeButton;

use Acomics\Ssr\Layout\AbstractComponent;

class SubscribeButton extends AbstractComponent
{
	private int $serialId;
	private bool $isSubscribed;

	public function __construct(int $serialId, bool $isSubscribed)
	{
		$this->serialId = $serialId;
		$this->isSubscribed = $isSubscribed;
	}

	public function render(): void
	{
?>
		<button class="subscribe-button" data-is-subscribed="<?=$this->isSubscribed?>" data-serial-id="<?=$this->serialId?>'">
			<span class="caption caption-subscribe">Подписаться</span>
			<span class="caption caption-subscribed">В подиске</span>
			<span class="caption caption-unsubscribe">Отписаться</span>
		</button>
<?php
	}
}
