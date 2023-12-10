'use strict';
(() => {

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
	makeSubscribeButtons();
};

init();

})();
