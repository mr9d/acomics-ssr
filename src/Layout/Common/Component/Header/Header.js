// Скрытие меню при скролле
const makeHeaderDisapearOnScroll = () => {
	const scrollUpClass = "scroll-up";
	const scrollDownClass = "scroll-down";
	let lastScroll = 0;

	const windowScrollLstener = () => {
		const currentScroll = window.scrollY;
		if (currentScroll <= 54) {
			document.body.classList.remove(scrollUpClass);
			return;
		}
		if (currentScroll > lastScroll && !document.body.classList.contains(scrollDownClass)) {
			document.body.classList.remove(scrollUpClass);
			document.body.classList.add(scrollDownClass);
		} else if (
			currentScroll < lastScroll &&
			document.body.classList.contains(scrollDownClass)
		) {
			document.body.classList.remove(scrollDownClass);
			document.body.classList.add(scrollUpClass);
		}
		lastScroll = currentScroll;
	};

	// Обработчик нужно добавить только после скролла по якорной ссылке (например, #title)
	const pageLoadAndScrolledHandler = () => {
		window.addEventListener("scroll", windowScrollLstener);
		window.removeEventListener('load', pageLoadAndScrolledHandler);
	};

	window.addEventListener('load', pageLoadAndScrolledHandler);
};
