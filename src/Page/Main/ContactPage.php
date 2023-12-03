<?php
namespace Acomics\Ssr\Page\Main;

use Acomics\Ssr\Layout\Common\Component\PageHeaderWithMenu\PageHeaderWithMenu;
use Acomics\Ssr\Layout\Main\MainLayout;
use Acomics\Ssr\Page\PageInt;

class ContactPage extends MainLayout implements PageInt
{
	public function __construct()
	{
		$this->title('Контактная информация команды портала Авторский Комикс');
	}

	public function content(): void
	{
		(new PageHeaderWithMenu('Авторский Комикс'))
			->item('/about', 'О проекте')
			->item('/rules', 'Правила портала')
			->item('/contact', 'Связаться с нами', true)
			->render();
?>

		<h2><a href="https://vk.com/acomics">Наша группа VK</a></h2>

		<p>В группе мы пишем об обновлениях портала, о новых комиксах и связанных с ними событиях.
			В группу можно обращаться по следующим вопросам:</p>

		<ul>
			<li>Предложить новость или информационное партнерство. Прежде чем написать вашу новость в предложку,
				ознакомьтесь <a href="https://vk.com/page-19453433_51763975">с этой статьей</a>.</li>
			<li>Задать вопрос по публикации комиксов
				<a href="https://vk.me/join/sHW6HzgwpsPxzmvUjjYxlSkhEciHIQIIKvI=">в общем чате-беседке</a> или
				<a href="https://vk.com/topic-19453433_48965514">в специальном обсуждении</a>.</li>
			<li>Обсудить любой другой вопрос связанный с комиксами
				<a href="https://vk.me/join/sHW6HzgwpsPxzmvUjjYxlSkhEciHIQIIKvI=">в чате-беседка</a>.</li>
			<li>Подать заявку на изменение возрастного рейтинга комикса
				<a href="https://vk.com/topic-19453433_48953605">в специальном обсуждении</a>.</li>
			<li>Предложить свою помощь в развитии нашего портала. Подробнее о способах помощи порталу
				<a href="https://vk.com/@acomics-types-of-support">в этой статье</a>.</li>
		</ul>

		<h2><a href="mailto:themrgd@gmail.com">Электронная почта</a></h2>

		<p>Это почта администратора портала. На нее можно писать по следующим вопросам:</p>

		<ul>
			<li>Предложения о сотрудничестве.</li>
			<li>Сообщения о нарушении правил портала.</li>
			<li>Просьбы изменить URL комикса, удалить или переименовать профиль пользователя.
				В этом случае пишите с той электронной почты, под которой вы зарегистрированы на портале.</li>
		</ul>

		<h2><a href="https://github.com/mr9d/acomics-public/issues?q=is%3Aissue+is%3Aopen+sort%3Aupdated-desc">Публичный список задач на GitHub</a></h2>

		<p>На GitHub мы публикуем задачи, которые планируем реализовать в будущем.
			Как предложить новую идею по улучшению портала, либо добавить ценный комментарий к уже запланированным улучшениям,
			читайте <a href="https://github.com/mr9d/acomics-public#%D1%81%D0%BE%D0%B7%D0%B4%D0%B0%D1%82%D1%8C-%D0%B7%D0%B0%D0%B4%D0%B0%D1%87%D1%83">в этой инструкции</a>.</p>

		<h2><a href="mailto:duke@acomics.ru">Электронная почта Дюка</a></h2>

		<p>Duke B. Garland — бывший ведущий разработчик Авторского Комикса. Сейчас он уже не занимается порталом,
			но из уважения к его работе мы оставили контакты для желающих с ним связаться.</p>


<?php
	}
}
