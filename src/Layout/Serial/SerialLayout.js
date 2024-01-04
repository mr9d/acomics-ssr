// Сохранение прочитанных комментариев (для страницы "Публикация")
const saveAuthorCommentsRead = () => {
	const serialHeader = document.querySelector('header.serial-header');
	const isAuthor = serialHeader.dataset.isAuthor === '1';
	if (!isAuthor) {
		return;
	}
	const serialId = serialHeader.dataset.serialId;
	console.log(serialId); //wip
};

// Удаляем #title из URL при перелистывании страниц
const removeTitleHashFromUrl = () => {
	if (window.location.hash !== '#title') {
		return;
	}
	const pageLoadAndScrolledHandler = () => {
		history.replaceState(null, null, window.location.pathname);
		window.removeEventListener('load', pageLoadAndScrolledHandler);
	};

	// Нужно выполнить только после скролла по якорной ссылке
	window.addEventListener('load', pageLoadAndScrolledHandler);
};

// Инициализация элементов на странице чтения комиксов
const init = () => {
	makeSerialMenuToggleButton();
	makeReaderNavigatorButtons();
	makeKeyboardNavigation();
	makeReaderUpButton();
	collapseLongComments();
	saveAuthorCommentsRead();
	removeTitleHashFromUrl();
};

init();
