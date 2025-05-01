function debounce(mainFunction, timeout = 300) {
	let timer;
	return (...args) => {
		clearTimeout(timer);
		timer = setTimeout(() => { mainFunction.apply(this, args); }, timeout);
	};
}

const throttle = (mainFunction, delay = 300) => {
	let timerFlag = null;

	return (...args) => {
		if (timerFlag === null) {
			mainFunction(...args);
			timerFlag = setTimeout(() => {
				timerFlag = null;
			}, delay);
		}
	};
};

// Инициализация общих элементов страницы
const init = () => {
	window.acomicsCommon = {
		debounce,
		throttle,
		makeDateTimeFormatted,
		makeLazyImages,
        makeSubscribeButtons,
	}

	makeHeaderMenu('div.user-menu', 'button.toggle-user-menu', 'user-menu-visible');
	makeHeaderMenu('div.main-menu', 'button.toggle-main-menu', 'main-menu-visible');
	makeSubscribeButtons();
	makePageHint();
	makeDateTimeFormatted(document);
	makeLazyImages();
    makeInfiniteScroll();
    makePaginator();
    makeAsyncFormsProcessing();
};

init();
