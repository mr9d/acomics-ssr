const serialMenuToggleButtonClickListener = (evt) => {
	const serialMenu = evt.target.closest('section.serial-reader-menu');
	serialMenu.classList.toggle('expanded');
};

const makeSerialMenuToggleButton = () => {
	const button = document.querySelector('button.serial-reader-menu-toggle');
	button.addEventListener('click', serialMenuToggleButtonClickListener);
};
