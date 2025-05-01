// Маркер поля, которое нужно обработать асинхронно перед отправкой формы
const ASYNC_FIELD_MARKER = 'data-async-processing';

// Обработка отправки формы с асинхронными полями
const processAsyncFormFields = async (evt) => {
    const form = evt.target;
    const asyncFields = form.querySelectorAll(`[${ASYNC_FIELD_MARKER}]`);
    if (asyncFields.length !== 0) {
        evt.preventDefault();
        form.setAttribute('disabled', 'disabled');
        const promises = [...asyncFields].map((asyncField) => {
            const fieldPromise = asyncField['processAsync'] ? asyncField['processAsync'](asyncField) : Promise.resolve();
            return fieldPromise.finally(() => asyncField.removeAttribute(ASYNC_FIELD_MARKER));
        });
        await Promise.allSettled(promises);
        form.removeAttribute('disabled');
        HTMLFormElement.prototype.requestSubmit.call(form, evt.submitter);
    }
};

// Инициализация асинхронных форм
const makeAsyncFormsProcessing = () => {
    const forms = document.querySelectorAll('form');
    forms.forEach((form) => {
        if (form.querySelector(`[${ASYNC_FIELD_MARKER}]`) !== null) {
            form.addEventListener('submit', processAsyncFormFields);
        }
    });
};
