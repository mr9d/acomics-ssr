// Инициализация главной страницы
const initIndexPage = () => {
    makeIndexCover();
    makeIndexFeatured();
    makeIndexSpotlight();
};

// Инициализация страниц каталога
const initCatalogPage = () => {
    makeCatalogFilters();
    makeCatalogSearchForm();
};

// Инициализация общих элементов страницы
const init = () => {
	window.acomicsMain = {
		initCatalogPage,
		initIndexPage,
	}

};

init();
