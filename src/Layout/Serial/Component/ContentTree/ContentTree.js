const collapsableHeadersClickListener = (evt) => {
    const header = evt.target
    header.classList.toggle('collapsed');
};

const makeContentCollapsableHeaders = () => {
    const headers = document.querySelectorAll('section.serial-content-tree h3.collapsable');
    headers.forEach(header => header.addEventListener('click', collapsableHeadersClickListener));
};
