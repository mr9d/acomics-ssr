const makeReaderListLoadMore = () => {
	let loadMoreLink = document.querySelector('a.reader-list-load-more');
	let isLoading = false;
	let loadCount = 4;

	if (loadMoreLink === null)
	{
		return;
	}

	const loadMoreIssues = async () => {
		isLoading = true;
		try {
			loadMoreLink.style.pointerEvents = 'none';

			const url = loadMoreLink.href;
			const html = await fetch(url).then(res => res.text());
			const parser = new DOMParser();
			const htmlDoc = parser.parseFromString(html, 'text/html');

			const container = htmlDoc.querySelector('main.list-container');
			container.querySelector('nav.reader-navigator').remove();
			loadMoreLink.after(...container.children);

			window.acomicsCommon.makeDateTimeFormatted(loadMoreLink.parentNode),
			window.acomicsCommon.makeLazyImages(),

			loadMoreLink.remove();
			loadMoreLink = document.querySelector('a.reader-list-load-more');
			loadCount--;
		} catch (err) {
			console.log(err);
			loadMoreLink.style.pointerEvents = '';
		}
		isLoading = false;
	};

	const windowScrollLstener = window.acomicsCommon.throttle(() => {
		if (loadMoreLink === null || loadCount === 0)
		{
			window.removeEventListener('scroll', windowScrollLstener);
			return;
		}
		if (!isLoading)
		{
			window.acomicsCommon.checkElementViewportPositionAndLoad(loadMoreLink, loadMoreIssues);
		}
	});

	window.addEventListener('scroll', windowScrollLstener);
};
