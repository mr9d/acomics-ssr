const LAZY_IMAGE_CLASS = 'lazy-image';
const LAZY_PRERENDER_HEIGHT = 150;

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
}

const makeLazyImages = (parentElement = document) => {
	let firstLazyImage = parentElement.querySelector('img.' + LAZY_IMAGE_CLASS);

	if (firstLazyImage === null) {
		return;
	}

	const loadImage = (img) => {
		img.setAttribute('src', img.dataset.realSrc);
		img.classList.remove(LAZY_IMAGE_CLASS);
	};

	const checkImage = (img) => {
		const imgViewportOffset = img.getBoundingClientRect().top;
		if (imgViewportOffset < window.innerHeight + LAZY_PRERENDER_HEIGHT) {
			loadImage(img);
			return true;
		} else {
			return false;
		}
	}

	const windowScrollLstener = throttle(() => {
		const visible = checkImage(firstLazyImage);
		if (visible) {
			const otherLazyImages = parentElement.querySelectorAll('img.' + LAZY_IMAGE_CLASS);
			for (const image of otherLazyImages) {
				const visible = checkImage(image);
				if (!visible) {
					firstLazyImage = image;
					return;
				}
			}
			window.removeEventListener('scroll', windowScrollLstener);
		}
	});

	window.addEventListener('scroll', windowScrollLstener);
};

