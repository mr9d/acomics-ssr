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
};

/* src/Layout/Main/MainLayout.js */

// Инициализация общих элементов страницы
const init = () => {
	window.acomicsMain = {
		makeCatalogFilters,
	}

};

init();

})();
