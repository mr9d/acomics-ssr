// Форматирование числа с подписью в строку: "1 стол, 2 стола, 5 столов"
const formatIntCaption = (integer, str1, str2, str3) => {
	const mod = integer % 10;
	const mod100 = integer % 100;
	if (mod100 > 10 && mod100 < 20) { return "" + integer + " " + str3; } // 5 столов
	if (mod === 0 || mod > 4) { return "" + integer + " " + str3; } // 5 столов
	else if (mod === 1) { return "" + integer + " " + str1; } // 1 стол
	else { return "" + integer + " " + str2; } // 2 стола
}

// Форматирование даты в человекочитаемый формат
function makeDateTimeFormatted(parentElement) {
	const elements = parentElement.querySelectorAll('span.date-time-formatted');
	for(const element of elements)
	{
		let delta = 0;
		if(element.innerText[0] === '=')
		{
			delta = parseInt(element.innerText.substring(1));
		}
		else if(element.dataset.delta)
		{
			delta = parseInt(element.dataset.delta);
		}
		else
		{
			break;
		}

		element.dataset.delta = delta;

		let text = '???';
		if (delta < 6) { text = 'Только что'; }
		else if (delta < 60) { text = formatIntCaption(delta, 'секунду назад', 'секунды назад', 'секунд назад'); }
		else if (delta < 3600) { delta = Math.floor(delta / 60); text = formatIntCaption(delta, 'минуту назад', 'минуты назад', 'минут назад'); }
		else if (delta < 12 * 3600) { delta = Math.floor(delta / 3600); text = formatIntCaption(delta, 'час назад', 'часа назад', 'часов назад'); }
		else {
			const now = new Date();
			const today = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 0, 0, 0, 0);
			const d = new Date(now.getTime() - delta * 1000);
			const mon = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
			if (delta < 27 * 24 * 3600) {
				if (today < d) {
					text = 'Сегодня';
				}
				else if (today - 24 * 3600 * 1000 < d) {
					text = 'Вчера';
				}
				else {
					text = '' + d.getDate() + ' ' + mon[d.getMonth()];
				}
				text = text + ' в ' + d.getHours() + ':' + ('0' + d.getMinutes()).slice(-2);
			}
			else if (delta < 90 * 24 * 3600) {
				text = '' + d.getDate() + ' ' + mon[d.getMonth()];
			}
			else {
				text = '' + d.getDate() + ' ' + mon[d.getMonth()];
				if (now.getFullYear() > d.getFullYear()) {
					text = text + ' ' + d.getFullYear() + ' года';
				}
			}
		}

		element.innerText = text;
	}
};
