const makeCatalogSearchForm = () => {
    // Сброс автофокуса в Safari на iPhone
    const form = document.querySelector('form.catalog-search-form');
    if (form === null) {
        return;
    }
    const input = form.querySelector('input[name="keyword"]');
    setInterval(() => input.removeAttribute('disabled'), 400);
};
