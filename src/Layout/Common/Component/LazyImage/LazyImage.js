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

