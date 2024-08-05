const changeSubscrCount = (button, delta) => {
    const subscrCountElement = button.querySelector('span.subscr-count');
    if (subscrCountElement) {
        subscrCountElement.innerText = +subscrCountElement.innerText + delta;
    }
};

const subscribeButtonClickListener = async (evt) => {
	evt.preventDefault();
	const button = evt.target.closest('button.subscribe-button');
	const serialId = button.dataset.serialId;
	const isSibscribed = button.dataset.isSubscribed === '1';

	if (!serialId) {
		alert('Не задан идентификатор комикса.');
		return false;
	}

	const apiUrl = '/ajax/subscribe?' + (isSibscribed ? 'unsubscribe=' : 'subscribe=') + serialId;
	const apiResponse = await fetch(apiUrl);
	const result = await apiResponse.text();

	if (result === '1') {
		const buttonsForSerial = document.querySelectorAll('button.subscribe-button[data-serial-id="' + serialId + '"]');
		buttonsForSerial.forEach((button) => {
            button.dataset.isSubscribed = '1';
            button.setAttribute('title', 'Отписаться');
            changeSubscrCount(button, 1);
        });
		button.classList.add('just-subscribed');
		setTimeout(() => button.classList.remove('just-subscribed'), 2000);
	} else if (result === '2') {
		const buttonsForSerial = document.querySelectorAll('button.subscribe-button[data-serial-id="' + serialId + '"]');
		buttonsForSerial.forEach((button) => {
            button.dataset.isSubscribed = '0';
            button.setAttribute('title', 'Подписаться');
            changeSubscrCount(button, -1);
        });
		return false;
	} else {
		alert(result);
	}
};

const makeSubscribeButtons = (parentElement = document) => {
	const buttons = parentElement.querySelectorAll('button.subscribe-button');
	buttons.forEach((button) => button.addEventListener('click', subscribeButtonClickListener));
}
