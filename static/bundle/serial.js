'use strict';
(() => {

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
	const issueCount = readerNavigator.dataset.issueCount;

	// Переход по номеру выпуска
	const gotoButton = readerNavigator.querySelector('li.button-goto a');
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
		window.location.assign(getCurrentSerialUrl() + '/' + Math.min(issueNumber, issueCount));
	});

	// Переход к случайному выпуску
	const randomButton = readerNavigator.querySelector('li.button-random a');
	randomButton.addEventListener('click', (evt) => {
		evt.preventDefault();
		const issueNumber = Math.floor(Math.random() * issueCount) + 1;
		window.location.assign(getCurrentSerialUrl() + '/' + issueNumber);
	});
};

// Навигация по кнопкам
const makeKeyboardNavigation = () => {
	const readerNavigator = document.querySelector('nav.reader-navigator');
	const issueCount = readerNavigator.dataset.issueCount;
	// todo
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
// Инициализация элементов на странице чтения комиксов
const init = () => {
	makeSerialMenuToggleButton();
	makeReaderNavigatorButtons();
	makeKeyboardNavigation();
	makeReaderUpButton();
};

init();

})();
