'use strict';
(() => {

/* src/Layout/Serial/Component/ContentTree/ContentTree.js */

/* src/Layout/Serial/Component/ReaderComment/ReaderComment.js */
const commentClickListener = (evt) => {
	if (evt.target.tagName !== 'BUTTON') {
		return;
	}
	if (evt.target.classList.contains('comment-expand') || evt.target.classList.contains('comment-collapse')) {
		const comment = evt.target.closest('article.reader-comment');
		comment.classList.toggle('reader-comment-expanded');
	}
};

// Схлопывание длинных комментариев
const collapseLongComments = () => {
	const comments = document.querySelectorAll('article.reader-comment');
	comments.forEach((comment) => {
		const height = comment.querySelector('section.comment-text').offsetHeight;
		if (height < 350) {
			return;
		}
		comment.classList.add('reader-comment-collapsable');
		comment.addEventListener('click', commentClickListener);
	});
};

/* src/Layout/Serial/Component/ReaderCommentForm/ReaderCommentForm.js */
const preventFormDoubleSubmission = () => {
    const form = document.querySelector('form.reader-comment-form');

    if (form === null) {
        return;
    }

    form.addEventListener('submit', () => {
        form.querySelector('button.submit').addEventListener('click', (evt) => evt.preventDefault());
    });
}

/* src/Layout/Serial/Component/ReaderListLoadMore/ReaderListLoadMore.js */
const makeReaderListLoadMore = () => {
	let loadMoreLink = document.querySelector('a.reader-list-load-more');
	let isLoading = false;
	let loadCount = 4;

	if (loadMoreLink === null)
	{
		return;
	}

	const loadMoreIssues = async () => {
		isLoading = true;
		try {
			loadMoreLink.style.pointerEvents = 'none';

			const url = loadMoreLink.href;
			const html = await fetch(url).then(res => res.text());
			const parser = new DOMParser();
			const htmlDoc = parser.parseFromString(html, 'text/html');

			const container = htmlDoc.querySelector('main.list-container');
			container.querySelector('nav.reader-navigator').remove();

			for (let element of [...container.children]) {
				loadMoreLink.parentNode.appendChild(element);

				// Инициализация рекламы
				if (element.classList.contains('list-aside')) {
					const script = element.querySelector('script');
					const newScript = document.createElement("script");
					newScript.innerText = script.innerText;
					script.remove();
					document.body.appendChild(newScript);
				}
			}

			window.acomicsCommon.makeDateTimeFormatted(loadMoreLink.parentNode),
			window.acomicsCommon.makeLazyImages(),

			loadMoreLink.remove();
			loadMoreLink = document.querySelector('a.reader-list-load-more');
			loadCount--;
		} catch (err) {
			console.log(err);
			loadMoreLink.style.pointerEvents = '';
		}
		isLoading = false;
	};

	const windowScrollLstener = window.acomicsCommon.throttle(() => {
		if (loadMoreLink === null || loadCount === 0)
		{
			window.removeEventListener('scroll', windowScrollLstener);
			return;
		}
		if (!isLoading)
		{
			window.acomicsCommon.checkElementViewportPositionAndLoad(loadMoreLink, loadMoreIssues);
		}
	});

	window.addEventListener('scroll', windowScrollLstener);
};

/* src/Layout/Serial/Component/ReaderMenu/ReaderMenu.js */
const serialMenuToggleButtonClickListener = (evt) => {
	const serialMenu = evt.target.closest('section.serial-reader-menu');
	serialMenu.classList.toggle('expanded');
};

const makeSerialMenuToggleButton = () => {
	const button = document.querySelector('button.serial-reader-menu-toggle');
	button.addEventListener('click', serialMenuToggleButtonClickListener);
};

/* src/Layout/Serial/Component/ReaderNavigator/ReaderNavigator.js */
// Ссылка на страницу открытого сейчас комикса
const getCurrentSerialUrl = () => {
	return window.location.origin + '/' + window.location.pathname.split('/')[1];
};

const makeReaderNavigatorButtons = () => {
	const readerNavigator = document.querySelector('nav.reader-navigator');
	if (readerNavigator === null)
	{
		return;
	}

	const issueCount = readerNavigator.dataset.issueCount;
	const listType = readerNavigator.dataset.listType === '1';

	// Переход по номеру выпуска
	const gotoButton = readerNavigator.querySelector('li.button-goto a');
	if (gotoButton !== null)
	{
		gotoButton.addEventListener('click', (evt) => {
			evt.preventDefault();
			const userUnput = prompt("К какому выпуску вы хотите перейти? (1.." + issueCount + ")","");
			if (userUnput === '' || userUnput == null) {
				return;
			}
			const issueNumber = parseInt(userUnput);
			if (isNaN(issueNumber) || issueNumber <= 0) {
				alert('Ошибка ввода');
				return;
			}
			const url = getCurrentSerialUrl() + '/' + (listType ? 'list?skip=' + Math.min(issueNumber - 1, issueCount - 1) : Math.min(issueNumber, issueCount));
			window.location.assign(url);
		});
	}

	// Переход к случайному выпуску
	const randomButton = readerNavigator.querySelector('li.button-random a');
	if (randomButton !== null)
	{
		randomButton.addEventListener('click', (evt) => {
			evt.preventDefault();
			const issueNumber = Math.floor(Math.random() * issueCount) + 1;
			window.location.assign(getCurrentSerialUrl() + '/' + issueNumber);
		});
	}
};

// Навигация по кнопкам
const makeKeyboardNavigation = () => {
	const readerNavigator = document.querySelector('nav.reader-navigator');
	if (readerNavigator === null)
	{
		return;
	}

	const keyboardNavigationListener = (evt) => {
		if(evt.target.tagName === 'TEXTAREA' || evt.target.tagName === 'INPUT') {
			return;
		}

		let navElement = null;
		if (evt.keyCode === 37) {
			navElement = readerNavigator.querySelector('.button-previous');
		} else if (evt.keyCode === 39) {
			navElement = document.querySelector('.button-next');
		}

		if (navElement !== null && !navElement.classList.contains('button-inactive')) {
			const href = navElement.querySelector('a').getAttribute('href');
			window.location.assign(href);
		}
	};

	document.addEventListener('keydown', keyboardNavigationListener);
};

/* src/Layout/Serial/Component/ReaderSerialDescription/ReaderSerialDescription.js */
// Кнопка "Наверх" в описании комикса
const makeReaderUpButton = () => {
	const upButton = document.querySelector('section.reader-serial-description a.description-up-button');
	if (upButton === null) {
		return;
	}
	upButton.addEventListener('click', (evt) => {
		evt.preventDefault();
		window.scrollTo({ top: 0, behavior: 'smooth' });
	});
};

/* src/Layout/Serial/SerialLayout.js */
// Сохранение прочитанных комментариев (для страницы "Публикация")
const saveAuthorCommentsRead = () => {
	const serialHeader = document.querySelector('header.serial-header');
	const isAuthor = serialHeader.dataset.isAuthor === '1';
	if (!isAuthor) {
		return;
	}
	const serialId = serialHeader.dataset.serialId;
	const commentsReadData = JSON.parse(localStorage.getItem('commentsRead') || '{}');
	const comments = document.querySelectorAll('article.reader-comment');
	if (comments.length === 0) {
		return;
	}
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

// Инициализация элементов на странице чтения комиксов
const init = () => {
	makeSerialMenuToggleButton();
	makeReaderNavigatorButtons();
	makeKeyboardNavigation();
	makeReaderUpButton();
	collapseLongComments();
	saveAuthorCommentsRead();
	removeTitleHashFromUrl();
	makeHeaderDisapearOnScroll();
	makeReaderListLoadMore();
    preventFormDoubleSubmission();
};

init();

})();
