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
