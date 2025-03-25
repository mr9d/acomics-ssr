// Форматирование переносов строк в title изображений и ссылок читалки
const formatReaderTitles = () => {
    document.querySelectorAll('.reader-issue img.issue, .reader-issue a.reader-issue-next').forEach(element => {
        const title = element.getAttribute('title');
        if (title) {
            const newTitle = title.replace(/\\r/g, '&#13;')
                                .replace(/\\n/g, '&#10;');
            const temp = document.createElement('div');
            temp.innerHTML = newTitle;
            element.setAttribute('title', temp.textContent);
        }
    });
};