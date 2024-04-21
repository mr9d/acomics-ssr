const makeInfiniteScroll = () => {
    const LINK_SELECTOR = 'a.infinite-scroll';
    const CONTENT_SELECTOR = 'div.infinite-scroll-content';

    let loadMoreLink = document.querySelector(LINK_SELECTOR);

    if (loadMoreLink === null) {
        return;
    }

    const pageContainer = loadMoreLink.closest(CONTENT_SELECTOR);
    const parser = new DOMParser();
    let isLoading = false;
    let loadCount = +loadMoreLink.dataset.maxLoads;

    const moveElements = (fromContainer, targetContainer) => {

        for (let element of [...fromContainer.children]) {
            targetContainer.appendChild(element);

            // Инициализация рекламы
            const script = element.querySelector('script');
            if (script !== null) {
                const newScript = document.createElement('script');
                newScript.innerText = script.innerText;
                script.remove();
                document.body.appendChild(newScript);
            }
        }
    };

    const loadMore = async () => {
        isLoading = true;
        loadMoreLink.classList.add('in-progress');

        try {
            loadMoreLink.style.pointerEvents = 'none';

            const url = loadMoreLink.href;
            const html = await fetch(url).then(res => res.text());
            const htmlDoc = parser.parseFromString(html, 'text/html');
            const fromContainer = htmlDoc.querySelector(CONTENT_SELECTOR);

            moveElements(fromContainer, pageContainer);

            window.acomicsCommon.makeDateTimeFormatted(loadMoreLink.parentNode);
            window.acomicsCommon.makeLazyImages();

            loadMoreLink.remove();
            loadMoreLink = document.querySelector(LINK_SELECTOR);
            loadCount--;
        } catch (err) {
            loadMoreLink.style.pointerEvents = '';
        }

        isLoading = false;
        loadMoreLink.classList.remove('in-progress');
    };

    const windowScrollLstener = window.acomicsCommon.throttle(() => {
        if (loadMoreLink === null || loadCount === 0) {
            window.removeEventListener('scroll', windowScrollLstener);
            return;
        }
        if (!isLoading) {
            window.acomicsCommon.checkElementViewportPositionAndLoad(loadMoreLink, loadMore);
        }
    });

    window.addEventListener('scroll', windowScrollLstener);
};
