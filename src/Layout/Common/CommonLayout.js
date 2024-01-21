const LAZY_PRERENDER_HEIGHT = 150;

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

// Проверка, находится ли элемент в зоне видимости для ленивой дозагрузки
const checkElementViewportPositionAndLoad = (element, loadFunction) => {
	const elementViewportOffset = element.getBoundingClientRect().top;
	if (elementViewportOffset < window.innerHeight + LAZY_PRERENDER_HEIGHT) {
		loadFunction(element);
		return true;
	} else {
		return false;
	}
};


// Инициализация общих элементов страницы
const init = () => {
	window.acomicsCommon = {
		debounce,
		throttle,
		checkElementViewportPositionAndLoad,
		makeDateTimeFormatted,
		makeLazyImages,
	}

	makeHeaderMenu('div.user-menu', 'button.toggle-user-menu', 'user-menu-visible');
	makeHeaderMenu('div.main-menu', 'button.toggle-main-menu', 'main-menu-visible');
	makeSubscribeButtons();
	makePageHint();
	makeDateTimeFormatted(document);
	makeLazyImages();
    makePaginator();
};

init();
