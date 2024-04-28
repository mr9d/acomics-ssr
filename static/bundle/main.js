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
    const form = document.querySelector('form.catalog-search-form');
    if (form === null) {
        return;
    }
    const input = form.querySelector('input[name="keyword"]');
    setInterval(() => input.removeAttribute('disabled'), 400);
};

/* src/Layout/Main/Component/IndexCover/IndexCover.js */
const makeIndexCover = () => {
    const coversCount = document.querySelectorAll('.index-cover .cover').length;

    new Swiper('.swiper-container', {
        loop: true,
        speed: 400,
        followFinger: coversCount > 1,
        pagination: {
            el: '.cover-pagination',
            clickableClass: 'cover-pagination',
            modifierClass: 'cover-pagination-',
            bulletClass: 'cover-pagination-bullet',
            bulletActiveClass: 'cover-pagination-bullet-active',
            clickable: true,
            progressbarOpposite: false,
            renderBullet: function (index, className) {
                return '<span class="' + className + '">' + (index % 2 == 0 ? '&#9650;' : '&#9660;') + '</span>';
            },
        },
        autoplay: {
            delay: coversCount > 1 ? 5000 : 999999,
        },
    });
};

/* src/Layout/Main/Component/IndexFeatured/IndexFeatured.js */
const makeIndexFeatured = () => {

};

/* src/Layout/Main/Component/IndexSpotlight/IndexSpotlight.js */
const makeIndexSpotlight = () => {

};

/* src/Layout/Main/MainLayout.js */
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

})();
