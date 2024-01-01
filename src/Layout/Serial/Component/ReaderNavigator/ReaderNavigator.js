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
