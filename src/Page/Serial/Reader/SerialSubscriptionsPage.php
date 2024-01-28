<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\Common\Component\Paginator\Paginator;
use Acomics\Ssr\Layout\SerialReaderAside\SerialReaderAsideLayout;
use Acomics\Ssr\Page\PageInt;
use Acomics\Ssr\Util\UrlUtil;

class SerialSubscriptionsPage extends SerialReaderAsideLayout implements PageInt
{
	protected ?SerialSubscriptionsPageData $pageData = null;

	public function pageData(SerialSubscriptionsPageData $pageData): void
	{
		$this->pageData = $pageData;
	}

	public function isReady(): bool
	{
		return $this->pageData !== null && parent::isReady();
	}

    public function content(): void
    {
		(new PageHeaderWithMenu('Подписчики'))->render();

        $this->description();

        (new Paginator($this->pageData->paginator, 'списка подписчиков'))->render();

        echo '<p>';
        echo implode(', ', array_map(fn($username) => '<a href="' . UrlUtil::makeProfileUrl($username) . '">' . $username . '</a>', $this->pageData->usernames));
        echo '</p>';

        (new Paginator($this->pageData->paginator, 'списка подписчиков'))->render();
    }

    private function description(): void
    {
        echo '<p>' . $this->pageData->message . '</p>';

        if($this->auth->isLoggedIn)
        {
            $this->subscribeForm();
        }
        else
        {
            echo '<p>Вы должны быть <a href="/auth/reg">зарегистрированы</a> и <a href="/auth/login">авторизованы</a> на сайте, чтобы подписываться на комиксы.</p>';
        }
    }

    private function subscribeForm(): void
    {
        $isSubscribed = $this->serialLayoutData->isSubscribed;
        echo '<form method="POST" action="/action/settingsSubscribes" enctype="multipart/form-data" class="serial-subscriptions-form">';
        echo '<input type="hidden" name="addType" value="code">';
        echo '<input type="hidden" name="addValue" value="' . $this->serialLayoutData->code . '">';
        echo '<button type="submit" name="submit" class="submit" value="' . ($isSubscribed ? 'delete' : 'add') . '">' . ($isSubscribed ? 'отписаться' : 'подписаться') . '</button>';
        echo '</form>'; // serial-subscriptions-form
    }
}
