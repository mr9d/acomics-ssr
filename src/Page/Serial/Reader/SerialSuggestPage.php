<?php

namespace Acomics\Ssr\Page\Serial\Reader;

use Acomics\Ssr\Dto\IssuePreviewDto;
use Acomics\Ssr\Layout\Common\Component\DateTimeFormatted\DateTimeFormatted;
use Acomics\Ssr\Layout\Common\Component\LazyImage\LazyImage;
use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\SerialReaderAside\SerialReaderAsideLayout;
use Acomics\Ssr\Page\PageInt;

class SerialSuggestPage extends SerialReaderAsideLayout implements PageInt
{
    private const ADD_SUGGESTION_ACTION_PATH = '/action/suggestIssue';
    private const DELETE_SUGGESTION_ACTION_PATH = '/action/deleteSuggestion';

	protected ?SerialSuggestPageData $pageData = null;

	public function pageData(SerialSuggestPageData $pageData): void
	{
		$this->pageData = $pageData;
	}

	public function isReady(): bool
	{
		return $this->pageData !== null && parent::isReady();
	}

    protected function head(): void
    {
        parent::head();

        // HTML-редактор
        echo '<link rel="stylesheet" href="/design/common/sceditor/default.min.css" type="text/css" media="all" />';
        echo '<script defer src="/design/common/js/jqueryplus.js"></script>';
        echo '<script defer src="/design/common/sceditor/jquery.sceditor.xhtml.min.js"></script>';
    }

	public function content(): void
	{
		(new PageHeaderWithMenu('Предложка комикса «' . $this->serialLayoutData->name . '»'))->render();

        if(!$this->auth->isLoggedIn)
        {
            $this->unregisteredWarning();
        }
        else
        {
            $this->intro();
            $this->issues();
            $this->form();
        }
	}

    private function unregisteredWarning(): void
    {
        echo '<p><a href="/auth/login">Войдите</a> или <a href="/auth/reg">зарегистрируйтесь</a> чтобы предлагать свои выпуски для комикса.</p>';
    }

    private function intro(): void
    {
        echo '<p class="serial-suggest-intro">';
        echo 'Вы можете отправить гостевой выпуск или фанарт для комикса ' . $this->serialLayoutData->name . '.
            Автор его увидит и сможет опубликовать на странице комикса.
            Ваша работа должна соответствовать <a href="/rules">правилам</a> портала Авторский Комикс
            и возрастному рейтингу <a href="/rating">' . $this->pageData->ageRating->nameShort . '</a>.';
        echo '</p>'; // serial-suggest-intro
    }

    private function issues(): void
    {
        if(count($this->pageData->issues) === 0)
        {
            return;
        }

        echo '<h2>Ваши выпуски на рассмотрении</h2>';

        echo '<section class="serial-about-issues">';

        foreach($this->pageData->issues as $issue)
        {
            $this->issuePreview($issue);
        }

        echo '</section>'; // serial-about-issues
    }

    private function issuePreview(IssuePreviewDto $issue): void
    {
        echo '<form class="serial-suggestion-delete-form" method="POST" action="' . self::DELETE_SUGGESTION_ACTION_PATH . '" enctype="multipart/form-data">';

        echo '<input name="issueId" type="hidden" value="' . $issue->id . '">';

		(new LazyImage(
			src: $issue->thumbUrl,
			stubSrc: '/static/img/tail-spin.svg',
			width: 200,
			height: 150,
			alt: 'Превью предложенного выпуска',
		))->render();

        echo '<p class="hover">';

        if ($issue->name)
        {
            echo '<span class="name">' . $issue->name . '</span>';
        }

        echo '<span class="date">';
        (new DateTimeFormatted($issue->postDate))->render();
        echo '</span>';

        echo '<button type="submit" name="submit" value="delete" onclick="return !!confirm(\'Вы уверены, что хотите удалить выпуск из предложки? (Это действие необратимо)\');">удалить</button>';

        echo '</p>'; // hover

        echo '</form>'; // serial-suggestion-delete-form
    }

    private function form(): void
    {
        echo '<form class="serial-suggest-form" method="POST" action="' . self::ADD_SUGGESTION_ACTION_PATH . '" enctype="multipart/form-data">';

        echo '<input name="serialId" type="hidden" value="' . $this->serialLayoutData->id . '">';

        $this->inputImage();
        $this->inputName();
        $this->inputDescription();
        $this->buttons();

        echo '</form>'; // serial-suggest-form
    }

    private function inputImage(): void
    {
        echo '<label for="input-image">Изображение:</label>';
		echo '<input name="image" id="input-image" type="file" class="file" value="" required data-limit="2097152">';

		echo '<div class="help">';

		echo '<p><b>Обязательное поле.</b> Максимальный размер файла: 2Mb.</p>';
		echo '<p>Изображения шириной больше 1024 пикселов будут автоматически cжаты.</p>';
		echo '<p>Максимально допустимая высота после сжатия: 10&nbsp;000 пикселов.</p>';

        echo '</div>'; // help
    }

    private function inputName(): void
    {
        echo '<label for="input-name">Название:</label>';
        echo '<input name="name" id="input-name" type="text" class="text" value="">';
        echo '<div class="help">Название будет отображаться сверху над вашей работой.</div>';
    }

    private function inputDescription(): void
    {
        echo '<label for="input-description">Описание:</label>';

        echo '<div class="description">';
        echo '<textarea name="description" id="input-description" type="text" class="text editor" style="width: 100%"></textarea>';
        echo '</div>'; // description

        echo '<div class="help">';
        echo 'Здесь можно написать любую вспомогательную информацию о вас и о загружаемой работе. Ее увидит автор комикса, а также читатели - уже после публикации.';
        echo '</div>'; // help
    }

    private function buttons(): void
    {
        echo '<div class="buttons">';
        echo '<button type="submit" name="submit" value="add">предложить выпуск</button>';
        echo '</div>'; // buttons
    }
}

