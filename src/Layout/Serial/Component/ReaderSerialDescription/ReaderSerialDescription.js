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
