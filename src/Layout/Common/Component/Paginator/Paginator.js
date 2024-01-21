const makePaginator = () => {
    const gotoButtonClickListener = (evt) => {
        const paginator = evt.target.closest('nav.common-paginator');
        const pageSize = +paginator.dataset.pageSize;
        const pageComplement = paginator.dataset.pageComplement;
        const pageCount = +paginator.querySelector('ul li:last-child').textContent;

        const userUnput = prompt('К какой странице ' + pageComplement + ' вы хотите перейти? (1..' + pageCount + ')', '');
        if (userUnput === '' || userUnput == null) {
            return;
        }
        const pageNumber = parseInt(userUnput);
        if (isNaN(pageNumber) || pageNumber <= 0) {
            alert('Ошибка ввода');
            return;
        }
        const url = '?skip=' + ((Math.min(pageNumber, pageCount) - 1) * pageSize);
        window.location.assign(url);
    };

    const makeGotoButtons = (paginator) => {
        const buttons = paginator.querySelectorAll('ul li.spacer span, ul li.current span');
        buttons.forEach(button => button.addEventListener('click', gotoButtonClickListener));
    };

    const paginators = document.querySelectorAll('nav.common-paginator');
    paginators.forEach(makeGotoButtons);
};
