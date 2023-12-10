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

/* src/Layout/Serial/SerialLayout.js */
// Инициализация элементов на странице чтения комиксов
const init = () => {
	makeSerialMenuToggleButton();
};

init();

})();
