const LAZY_IMAGE_CLASS = 'lazy-image';

const makeLazyImages = (parentElement = document) => {
	let firstLazyImage = parentElement.querySelector('img.' + LAZY_IMAGE_CLASS);

	if (firstLazyImage === null) {
		return;
	}

	const loadImage = (img) => {
		img.setAttribute('src', img.dataset.realSrc);
		img.classList.remove(LAZY_IMAGE_CLASS);
	};

	const windowScrollLstener = window.acomicsCommon.throttle(() => {
		const visible = window.acomicsCommon.checkElementViewportPositionAndLoad(firstLazyImage, loadImage);
		if (visible) {
			const otherLazyImages = parentElement.querySelectorAll('img.' + LAZY_IMAGE_CLASS);
			for (const image of otherLazyImages) {
				const visible = window.acomicsCommon.checkElementViewportPositionAndLoad(image, loadImage);
				if (!visible) {
					firstLazyImage = image;
					return;
				}
			}
			window.removeEventListener('scroll', windowScrollLstener);
		}
	});

	window.addEventListener('scroll', windowScrollLstener);

	// Нужно также выполнить после скролла по якорной ссылке
	window.addEventListener('load', windowScrollLstener);
};

