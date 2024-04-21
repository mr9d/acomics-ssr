// Сохранение прочитанных комментариев (для страницы "Публикация")
const saveAuthorCommentsRead = () => {
	const comments = document.querySelectorAll('article.reader-comment');
	if (comments.length === 0) {
		return;
	}
	const serialHeader = document.querySelector('header.serial-header');
	const isAuthor = serialHeader.dataset.isAuthor === '1';
	if (!isAuthor) {
		return;
	}
	const serialId = serialHeader.dataset.serialId;
	const commentsReadData = JSON.parse(localStorage.getItem('commentsRead') || '{}');
	const delta = comments[comments.length - 1].querySelector('span.date-time-formatted').dataset.delta;
	const commentTime = Math.round(Date.now() / 1000) - delta;
	if((commentsReadData['c' + serialId] || 0) < commentTime) {
		commentsReadData['c' + serialId] = commentTime;
		localStorage.setItem('commentsRead', JSON.stringify(commentsReadData));
	}
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

// Скрытие меню при скролле
const makeHeaderDisapearOnScroll = () => {
	const scrollUpClass = "scroll-up";
	const scrollDownClass = "scroll-down";
	let lastScroll = 0;

	const windowScrollLstener = () => {
		const currentScroll = window.scrollY;
		if (currentScroll <= 54) {
			document.body.classList.remove(scrollUpClass);
			return;
		}
		if (currentScroll > lastScroll && !document.body.classList.contains(scrollDownClass)) {
			document.body.classList.remove(scrollUpClass);
			document.body.classList.add(scrollDownClass);
		} else if (
			currentScroll < lastScroll &&
			document.body.classList.contains(scrollDownClass)
		) {
			document.body.classList.remove(scrollDownClass);
			document.body.classList.add(scrollUpClass);
		}
		lastScroll = currentScroll;
	};

	// Обработчик нужно добавить только после скролла по якорной ссылке (например, #title)
	const pageLoadAndScrolledHandler = () => {
		window.addEventListener("scroll", windowScrollLstener);
		window.removeEventListener('load', pageLoadAndScrolledHandler);
	};

	window.addEventListener('load', pageLoadAndScrolledHandler);
};

// Инициализация читалки
const initReaderPage = () => {
    makeReaderNavigatorButtons();
	makeKeyboardNavigation();
	makeReaderUpButton();
	removeTitleHashFromUrl();
	makeHeaderDisapearOnScroll();
	makeReaderListLoadMore(); // replace with makeInfiniteScroll
    preventFormDoubleSubmission();
};

// Инициализация страницы содержания
const initContentPage = () => {
    makeContentCollapsableHeaders();
};

// Инициализация элементов на странице чтения комиксов
const init = () => {
	makeSerialMenuToggleButton();
	collapseLongComments();
	saveAuthorCommentsRead();

	window.acomicsSerial = {
		initReaderPage,
		initContentPage,
	}
};

init();
