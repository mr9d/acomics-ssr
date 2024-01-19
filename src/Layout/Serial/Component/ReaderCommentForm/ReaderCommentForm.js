const preventFormDoubleSubmission = () => {
    const form = document.querySelector('form.reader-comment-form');

    if (form === null) {
        return;
    }

    form.addEventListener('submit', () => {
        form.querySelector('button.submit').addEventListener('click', (evt) => evt.preventDefault());
    });
}
