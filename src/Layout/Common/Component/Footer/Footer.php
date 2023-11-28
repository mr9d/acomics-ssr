<?php

namespace Acomics\Ssr\Layout\Common\Component\Footer;

use Acomics\Ssr\Layout\AbstractComponent;

class Footer extends AbstractComponent
{
    public function render(): void
    {
?>
		<footer class="common-footer">

			<section class="footer-sponsor">
				<div class="sponsor-aks"></div>
				<p class="support-highlight"><a href="https://boosty.to/acomics">Поддержи Авторский Комикс!</a></a>
				<p class="subscribe-highlight">Подпишись на наш <a href="https://boosty.to/acomics">Boosty</a> или <a href="https://vk.com/donut/acomics">VK Donut</a>.</p>
			</section>

			<section class="footer-main">
				<nav>
					<ul>
						<li><a href="/about">О проекте</a></li>
						<li><a href="/contact">Связаться с нами</a></li>
						<li><a href="/rules">Правила портала</a></li>
						<li><a href="https://a-comics.ru/forum/">Архив форума</a></li>
						<li><a href="https://webcomunity.net/">Архив статей</a></li>
						<li><a href="https://mr9d.github.io/acomicsapi/">API</a></li>
					</ul>
				</nav>

				<form method="GET" action="/search">
					<div class="wrapper">
						<input type="text" class="text" name="keyword" value="" placeholder="Найти комикс в каталоге" pattern=".{3,}" title="Минимальное количество символов для поиска: 3" />
						<button type="submit" class="submit"><span></span></button>
					</div>
				</form>

				<p><span>&copy; 2008&ndash;<?=date("Y")?> Авторский Комикс.</span> <span>Все работы, размещенные на сайте, принадлежат их авторам.</span></p>
			</section>

		</footer>
<?php
    }
}
