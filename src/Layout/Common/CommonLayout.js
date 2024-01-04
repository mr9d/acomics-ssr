// Инициализация общих элементов страницы
const init = () => {
	makeHeaderMenu('div.user-menu', 'button.toggle-user-menu', 'user-menu-visible');
	makeHeaderMenu('div.main-menu', 'button.toggle-main-menu', 'main-menu-visible');
	makeSubscribeButtons();
	makePageHint();
	makeDateTimeFormatted(document);

	window.common = {
		makeDateTimeFormatted
	}
};

init();
