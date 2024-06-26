<?php
namespace Acomics\Ssr\Page\Main;

use Acomics\Ssr\Layout\Common\Component\LazyImage\LazyImage;
use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\Common\Component\SectionHeader\SectionHeader;
use Acomics\Ssr\Layout\Main\MainLayout;
use Acomics\Ssr\Page\PageInt;
use Acomics\Ssr\Util\UrlUtil;

class AboutPage extends MainLayout implements PageInt
{
	public function __construct()
	{
		$this->title('О проекте Авторский Комикс');
	}

	public function content(): void
	{
		(new PageHeaderWithMenu('Авторский Комикс'))
			->item('/about', 'О проекте', true)
			->item('/rules', 'Правила портала')
			->item('/contact', 'Связаться с нами')
			->render();

        $this->overview();
        $this->team();
        $this->mascot();
	}

    private function overview(): void
    {
?>
		<p>Авторский Комикс — сервис для публикации и чтения веб-комиксов.</p>

		<p>Наша команда поддерживает и развивает крупнейший каталог комиксов на русском языке,
			который пополняется самими авторами. Когда мы начали свою работу в 2008 году, во всем интернете было не более
			двух десятков русских веб-комиксов. Сегодня в нашем каталоге доступно более 4000 комиксов, более 500
			из которых это активно обновляющиеся серии.</p>

		<p><b>Читать комиксы должно быть удобно</b> — это первый принцип нашего портала. Чтобы опубликовать комикс в соцсетях
			или на непрофильном сайте, обычно приходится приспосабливать интерфейс этого сайта под чтение комиксов
			и мириться со сжатием картинок. У нас ничего приспосабливать не нужно: навигация между страницами
			понятна интуитивно, а изображение выводится в том же формате, в котором его загрузил автор.</p>

		<p><b>Все в руках авторов</b> — это наш второй главный принцип. Мы сделали удобный интерфейс, через который художники
			и переводчики могут самостоятельно создавать, настраивать и обновлять свои комиксы без участия администрации.
			Даже если комикс потребуется удалить из публичного доступа, например, по требованию издательства,
			автор сможет это сделать без препятствий.</p>

		<p><b>С уважением к авторским правам</b> — еще одно правило, которому мы неукоснительно следуем.
			Мы не публикуем на портале пиратский контент (так называемые «сканлейты» — переводы сканов),
			но и не требуем от авторов эксклюзивности при выкладывании их работ. В отличие от других сайтов
			для публикации комиксов, 75% комиксов у нас это оригинальные авторские работы и только 25% — переводы.</p>

		<p>Мы хотим сделать наш сервис еще лучше и у нас большие планы на его развитие.
			Мы опубликовали <a href="https://github.com/mr9d/acomics-public/issues?q=is%3Aissue+is%3Aopen+sort%3Aupdated-desc">список задач</a>,
			которые планируем реализовать. Если хотите помочь нам в развитии портала, оформите платную подписку
			на наш <a href="https://boosty.to/acomics">Boosty</a> или <a href="https://vk.com/donut/acomics">VK Donut</a>.
			Существуют и другие неденежные <a href="https://vk.com/@acomics-types-of-support">способы поддержать нас</a>.</p>

		<p>Если вы представитель СМИ или блоггер и хотите рассказать о нас, либо предложить сотрудничество,
			то <a href="/contact">напишите нам</a>.</p>
<?php
    }

    private function team(): void
    {
        (new SectionHeader('Наша команда'))->render();

        echo '<div class="about-team">';

        $this->teamMember('/design/images/team/kaa.png', 'Александр Козлов', 'kaa', 'Разработчик и администратор');
        $this->teamMember('/design/images/team/Foust.png', 'Яна Колестро', 'Foust', 'Помощник администратора');
        $this->teamMember('/design/images/team/Enjoyable.png', 'Анна Хилл', 'Enjoyable', 'Редактор каталога');
        $this->teamMember('/design/images/team/terentyi.png', 'Анна Терентьева', 'terentyi', 'Редактор статей');
        $this->teamMember('/design/images/team/Werewolf710.png', 'Любовь Арбузова', 'Werewolf710', 'Модератор группы VK');
        $this->teamMember('/design/images/team/kotalmaty.png', 'Кот Из Алма-Аты', 'kotalmaty', 'Редактор обложек');

        echo '</div>'; // about-team
    }

    private function teamMember(
        string $portraitSrc,
        string $name,
        string $username,
        string $title
    ): void
    {
        echo '<p class="about-team-member">';

        (new LazyImage(
            src: $portraitSrc,
            stubSrc: '/static/img/tail-spin.svg',
            width: 235,
            height: 300,
            alt: $name,
            class: 'about-team-member-portrait'
        ))->render();

        echo '<a href="' . UrlUtil::makeProfileUrl($username) . '" class="about-team-member-name">' . $name . '</a>';

        echo '<span class="about-team-member-title">' . $title . '</span>';

        echo '</p>'; // about-team-member
    }

    private function mascot(): void
    {
        (new SectionHeader('Наш маскот'))->render();

        echo '<p class="about-mascotrefs">';

        echo '<img src="/design/images/mascotrefs/refsheet01.png" alt="Акс - маскот Авторского Комикса: картинка 1">';
        echo '<img src="/design/images/mascotrefs/refsheet02.png" alt="Акс - маскот Авторского Комикса: картинка 2">';

        echo '</p>'; // about-mascotrefs
    }
}
