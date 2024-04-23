'use strict';
(() => {

/* src/Layout/Main/Component/CatalogFiltersForm/CatalogFiltersForm.js */
const makeCatalogFilters = () => {
    const form = document.querySelector('form.catalog-filters-form');

    if(form === null) {
        return;
    }

    const mobileSection = form.querySelector('section.form-mobile');
    const desktopSection = form.querySelector('section.form-desktop');

    const showDesktopFilters = (evt) => {
        evt.preventDefault();
        mobileSection.style.display = 'none';
        desktopSection.style.display = 'block';
    };

    const showFiltersButton = mobileSection.querySelector('button.show-filters-button');
    showFiltersButton.addEventListener('click', showDesktopFilters);

    const toggleForm = (evt) => {
        evt.preventDefault();
        desktopSection.classList.toggle('full');
    };

    const toggleFormButton = desktopSection.querySelector('button.full-form-toggle');
    toggleFormButton.addEventListener('click', toggleForm);
};

/* src/Layout/Main/Component/CatalogSearchForm/CatalogSearchForm.js */
const makeCatalogSearchForm = () => {
    // Сброс автофокуса в Safari на iPhone
    window.focus();
};

/* src/Layout/Main/MainLayout.js */
// Инициализация страниц каталога
const initCatalogPage = () => {
    makeCatalogFilters();
    makeCatalogSearchForm();
};


// Инициализация общих элементов страницы
const init = () => {
	window.acomicsMain = {
		initCatalogPage,
	}

};

init();

})();
