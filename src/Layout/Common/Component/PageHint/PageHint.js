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
