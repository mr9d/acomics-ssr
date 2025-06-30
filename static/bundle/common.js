'use strict';
(() => {

/* src/Layout/Common/Component/AsyncForm/AsyncForm.js */
// Маркер поля, которое нужно обработать асинхронно перед отправкой формы
const ASYNC_FIELD_MARKER = 'data-async-processing';

// Обработка отправки формы с асинхронными полями
const processAsyncFormFields = async (evt) => {
    const form = evt.target;
    const asyncFields = form.querySelectorAll(`[${ASYNC_FIELD_MARKER}]`);
    if (asyncFields.length !== 0) {
        evt.preventDefault();
        form.setAttribute('disabled', 'disabled');
        const promises = [...asyncFields].map((asyncField) => {
            const fieldPromise = asyncField['processAsync'] ? asyncField['processAsync'](asyncField) : Promise.resolve();
            return fieldPromise;
        });
        await Promise.allSettled(promises);
        form.removeEventListener('submit', processAsyncFormFields);
        form.removeAttribute('disabled');
        HTMLFormElement.prototype.requestSubmit.call(form, evt.submitter);
    }
};

// Инициализация асинхронных форм
const makeAsyncFormsProcessing = () => {
    const forms = document.querySelectorAll('form');
    forms.forEach((form) => {
        if (form.querySelector(`[${ASYNC_FIELD_MARKER}]`) !== null) {
            form.addEventListener('submit', processAsyncFormFields);
        }
    });
};

/* src/Layout/Common/Component/DateTimeFormatted/DateTimeFormatted.js */
// Форматирование числа с подписью в строку: "1 стол, 2 стола, 5 столов"
const formatIntCaption = (integer, str1, str2, str3) => {
	const mod = integer % 10;
	const mod100 = integer % 100;
	if (mod100 > 10 && mod100 < 20) { return "" + integer + " " + str3; } // 5 столов
	if (mod === 0 || mod > 4) { return "" + integer + " " + str3; } // 5 столов
	else if (mod === 1) { return "" + integer + " " + str1; } // 1 стол
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
		else if(element.dataset.delta)
		{
			delta = parseInt(element.dataset.delta);
		}
		else
		{
			break;
		}

		element.dataset.delta = delta;

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

/* src/Layout/Common/Component/InfiniteScroll/InfiniteScroll.js */
const makeInfiniteScroll = () => {
    const LINK_SELECTOR = 'a.infinite-scroll';
    const CONTENT_SELECTOR = 'div.infinite-scroll-content';

    let loadCount = null;

    const moveElements = (fromContainer, targetContainer) => {
        for (let element of [...fromContainer.children]) {
            targetContainer.appendChild(element);
            // Инициализация инлайновых скриптов
            const script = element.querySelector('script');
            if (script !== null) {
                const newScript = document.createElement('script');
                newScript.innerText = script.innerText;
                script.remove();
                document.body.appendChild(newScript);
            }
        }
    };

    const loadInfiniteScroll = async (loadMoreLink, pageContainer) => {
        loadMoreLink.classList.add('in-progress');

        try {
            loadMoreLink.style.pointerEvents = 'none';

            const parser = new DOMParser();
            const url = loadMoreLink.href;
            const html = await fetch(url).then(res => res.text());
            const htmlDoc = parser.parseFromString(html, 'text/html');
            const fromContainer = htmlDoc.querySelector(CONTENT_SELECTOR);

            moveElements(fromContainer, pageContainer);

            window.acomicsCommon.makeDateTimeFormatted(pageContainer);
            window.acomicsCommon.makeLazyImages(pageContainer);
            window.acomicsCommon.makeSubscribeButtons(pageContainer);

            loadMoreLink.remove();
            init();
        } catch (err) {
            loadMoreLink.style.pointerEvents = '';
            loadMoreLink.classList.remove('in-progress');
            console.error(err);
        }
    };

    const infiniteScrollObserver = ("IntersectionObserver" in window) ? new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const loadMoreLink = entry.target;
                const container = loadMoreLink.closest(CONTENT_SELECTOR);
                loadInfiniteScroll(loadMoreLink, container);
                observer.unobserve(loadMoreLink);
            }
        });
    }) : null;

    const init = () => {
        const loadMoreLink = document.querySelector(LINK_SELECTOR);

        if (loadMoreLink === null) {
            return;
        }

        if (loadCount === null) {
            loadCount = +loadMoreLink.dataset.maxLoads - 1;
        } else {
            loadCount--;
        }

        if (loadCount === 0) {
            return;
        }

        if (infiniteScrollObserver !== null) {
            infiniteScrollObserver.observe(loadMoreLink);
        }
    };

    init();
};

/* src/Layout/Common/Component/LazyContent/LazyContent.js */

/* src/Layout/Common/Component/LazyImage/LazyImage.js */
const LAZY_IMAGE_CLASS = 'lazy-image';

const loadLazyImage = (img) => {
    img.setAttribute('src', img.dataset.realSrc);
    img.dataset.realSrc = undefined;
    img.classList.remove(LAZY_IMAGE_CLASS);
};

const lazyImagesObserver = ("IntersectionObserver" in window) ? new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            const image = entry.target;
            loadLazyImage(image);
            observer.unobserve(image);
        }
    });
}) : null;

const makeLazyImages = (parentElement = document) => {
	let lazyImages = parentElement.querySelectorAll('img.' + LAZY_IMAGE_CLASS);

	if (lazyImages.length === 0) {
		return;
	}

	lazyImages.forEach((image) => {
        if (lazyImagesObserver !== null) {
            lazyImagesObserver.observe(image);
        } else {
            loadLazyImage(image);
        }
    });
};


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

/* src/Layout/Common/Component/Paginator/Paginator.js */
const makePaginator = () => {
    const gotoButtonClickListener = (evt) => {
        const paginator = evt.target.closest('nav.common-paginator');
        const pageSize = +paginator.dataset.pageSize;
        const pageComplement = paginator.dataset.pageComplement;
        const pageCount = +paginator.querySelector('ul li:last-child').textContent;

        const userUnput = prompt('К какой странице ' + pageComplement + ' вы хотите перейти? (1..' + pageCount + ')', '');
        if (userUnput === '' || userUnput == null) {
            return;
        }
        const pageNumber = parseInt(userUnput);
        if (isNaN(pageNumber) || pageNumber <= 0) {
            alert('Ошибка ввода');
            return;
        }
        const url = '?skip=' + ((Math.min(pageNumber, pageCount) - 1) * pageSize);
        window.location.assign(url);
    };

    const makeGotoButtons = (paginator) => {
        const buttons = paginator.querySelectorAll('ul li.spacer span, ul li.current span');
        buttons.forEach(button => button.addEventListener('click', gotoButtonClickListener));
    };

    const paginators = document.querySelectorAll('nav.common-paginator');
    paginators.forEach(makeGotoButtons);
};

/* src/Layout/Common/Component/SubscribeButton/SubscribeButton.js */
const changeSubscrCount = (button, delta) => {
    const subscrCountElement = button.querySelector('span.subscr-count');
    if (subscrCountElement) {
        subscrCountElement.innerText = +subscrCountElement.innerText + delta;
    }
};

const subscribeButtonClickListener = async (evt) => {
	evt.preventDefault();
	const button = evt.target.closest('button.subscribe-button');
	const serialId = button.dataset.serialId;
	const isSibscribed = button.dataset.isSubscribed === '1';

	if (!serialId) {
		alert('Не задан идентификатор комикса.');
		return false;
	}

	const apiUrl = '/ajax/subscribe?' + (isSibscribed ? 'unsubscribe=' : 'subscribe=') + serialId;
	const apiResponse = await fetch(apiUrl);
	const result = await apiResponse.text();

	if (result === '1') {
		const buttonsForSerial = document.querySelectorAll('button.subscribe-button[data-serial-id="' + serialId + '"]');
		buttonsForSerial.forEach((button) => {
            button.dataset.isSubscribed = '1';
            button.setAttribute('title', 'Отписаться');
            changeSubscrCount(button, 1);
        });
		button.classList.add('just-subscribed');
		setTimeout(() => button.classList.remove('just-subscribed'), 2000);
	} else if (result === '2') {
		const buttonsForSerial = document.querySelectorAll('button.subscribe-button[data-serial-id="' + serialId + '"]');
		buttonsForSerial.forEach((button) => {
            button.dataset.isSubscribed = '0';
            button.setAttribute('title', 'Подписаться');
            changeSubscrCount(button, -1);
        });
		return false;
	} else {
		alert(result);
	}
};

const makeSubscribeButtons = (parentElement = document) => {
	const buttons = parentElement.querySelectorAll('button.subscribe-button');
	buttons.forEach((button) => button.addEventListener('click', subscribeButtonClickListener));
}

/* src/Layout/Common/CommonLayout.js */
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

})();
