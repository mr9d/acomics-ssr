'use strict';
(() => {

/* src/Layout/Common/Component/DateTimeFormatted/DateTimeFormatted.js */
// Форматирование числа с подписью в строку: "1 стол, 2 стола, 5 столов"
const formatIntCaption = (integer, str1, str2, str3) => {
	const mod = integer % 10;
	const mod100 = integer % 100;
	if (mod100 > 10 && mod100 < 20) { return "" + integer + " " + str3; } // 5 столов
	if (mod == 0 || mod > 4) { return "" + integer + " " + str3; } // 5 столов
	else if (mod == 1) { return "" + integer + " " + str1; } // 1 стол
	else { return "" + integer + " " + str2; } // 2 стола
}

// Форматирование даты в человекочитаемый формат
function makeDateTimeFormatted(parentElement) {
	const elements = parentElement.querySelectorAll('span.date-time-formatted');
	for(const element of elements)
	{
		let delta = 0;
		if(element.innerText[0] === '=')
		{
			delta = parseInt(element.innerText.substring(1));
		}
		else if(element.getAttribute('bkup'))
		{
			delta = parseInt(element.getAttribute('bkup'));
		}
		else
		{
			break;
		}

		element.setAttribute('bkup', delta);

		let text = '???';
		if (delta < 6) { text = 'Только что'; }
		else if (delta < 60) { text = formatIntCaption(delta, 'секунду назад', 'секунды назад', 'секунд назад'); }
		else if (delta < 3600) { delta = Math.floor(delta / 60); text = formatIntCaption(delta, 'минуту назад', 'минуты назад', 'минут назад'); }
		else if (delta < 12 * 3600) { delta = Math.floor(delta / 3600); text = formatIntCaption(delta, 'час назад', 'часа назад', 'часов назад'); }
		else {
			const now = new Date();
			const today = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 0, 0, 0, 0);
			const d = new Date(now.getTime() - delta * 1000);
			const mon = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
			if (delta < 27 * 24 * 3600) {
				if (today < d) {
					text = 'Сегодня';
				}
				else if (today - 24 * 3600 * 1000 < d) {
					text = 'Вчера';
				}
				else {
					text = '' + d.getDate() + ' ' + mon[d.getMonth()];
				}
				text = text + ' в ' + d.getHours() + ':' + ('0' + d.getMinutes()).slice(-2);
			}
			else if (delta < 90 * 24 * 3600) {
				text = '' + d.getDate() + ' ' + mon[d.getMonth()];
			}
			else {
				text = '' + d.getDate() + ' ' + mon[d.getMonth()];
				if (now.getFullYear() > d.getFullYear()) {
					text = text + ' ' + d.getFullYear() + ' года';
				}
			}
		}

		element.innerText = text;
	}
};

/* src/Layout/Common/Component/Header/Header.js */
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

/* src/Layout/Common/Component/HeaderModal/HeaderModal.js */
// Проверка наличия вертикального скролла
const isScrollVisible = () => {
	return document.body.clientHeight > document.scrollingElement.clientHeight;
}

// Инициализация меню в шапке
const makeHeaderMenu = (menuSelector, buttonSelector, visibleClass) => {
	const menuElement = document.querySelector(menuSelector);
	const buttonElement = document.querySelector(buttonSelector);

	const showMenu = () => {
		document.body.classList.add(visibleClass);

		if (!(document.body.classList.contains('user-menu-visible') && document.body.classList.contains('main-menu-visible'))) {
			document.body.style.top = `-${window.scrollY}px`;
			document.body.style.position = 'fixed';
			if (isScrollVisible()) {
				document.body.style.overflowY = 'scroll';
			}
		}

		buttonElement.removeEventListener('click', showMenu);
		menuElement.addEventListener('click', hideMenu);
		buttonElement.addEventListener('click', hideMenu);
	};

	const hideMenu = () => {
		if (!(document.body.classList.contains('user-menu-visible') && document.body.classList.contains('main-menu-visible'))) {
			const scrollY = document.body.style.top;
			document.body.style.position = '';
			document.body.style.top = '';
			window.scrollTo(0, parseInt(scrollY || '0') * -1);
			document.body.style.overflowY = '';
		}

		document.body.classList.remove(visibleClass);

		menuElement.removeEventListener('click', hideMenu);
		buttonElement.removeEventListener('click', hideMenu);
		buttonElement.addEventListener('click', showMenu);
	};

	buttonElement.addEventListener('click', showMenu);
	menuElement.querySelector('nav').addEventListener('click', (evt) => evt.stopPropagation());
}

/* src/Layout/Common/Component/PageHint/PageHint.js */
const makePageHint = () => {
	const pageHint = document.querySelector('section.common-page-hint');
	if (pageHint === null) {
		return;
	}
	
	const closeId = pageHint.dataset.closeId;
	if (closeId === '') {
		return;
	}

	const closePageHint = () => {
		pageHint.classList.add('page-hint-closed');
	}

	if (localStorage.getItem('nohint-' + closeId) !== null) {
		closePageHint();
		return;
	}

	const closeButton = pageHint.querySelector('button.page-hint-close');
	closeButton.addEventListener('click', () => {
		localStorage.setItem('nohint-' + closeId, Date.now());
		closePageHint();
	});
};

/* src/Layout/Common/Component/SubscribeButton/SubscribeButton.js */
const subscribeButtonClickListener = async (evt) => {
	evt.preventDefault();
	const button = evt.target.closest('button.subscribe-button');
	const serialId = button.dataset.serialId;
	const isSibscribed = button.dataset.isSubscribed === 'true';

	if (!serialId) {
		alert('Не задан идентификатор комикса.');
		return false;
	}

	const apiUrl = '/ajax/subscribe?' + (isSibscribed ? 'unsubscribe=' : 'subscribe=') + serialId;
	const apiResponse = await fetch(apiUrl);
	const result = await apiResponse.text();

	if (result === '1') {
		const buttonsForSerial = document.querySelectorAll('button.subscribe-button[data-serial-id="' + serialId + '"]');
		buttonsForSerial.forEach((button) => button.dataset.isSubscribed = 'true');
		button.classList.add('just-subscribed');
		setTimeout(() => button.classList.remove('just-subscribed'), 2000);
	} else if (result === '2') {
		const buttonsForSerial = document.querySelectorAll('button.subscribe-button[data-serial-id="' + serialId + '"]');
		buttonsForSerial.forEach((button) => button.dataset.isSubscribed = 'false');
		return false;
	} else {
		alert(result);
	}
};

const makeSubscribeButtons = () => {
	const buttons = document.querySelectorAll('button.subscribe-button');
	buttons.forEach((button) => button.addEventListener('click', subscribeButtonClickListener));
}

/* src/Layout/Common/CommonLayout.js */
// Инициализация общих элементов страницы
const init = () => {
	makeHeaderMenu('div.user-menu', 'button.toggle-user-menu', 'user-menu-visible');
	makeHeaderMenu('div.main-menu', 'button.toggle-main-menu', 'main-menu-visible');
	makeHeaderDisapearOnScroll();
	makeSubscribeButtons();
	makePageHint();
	makeDateTimeFormatted(document);

	window.common = {
		makeDateTimeFormatted
	}
};

init();

})();
