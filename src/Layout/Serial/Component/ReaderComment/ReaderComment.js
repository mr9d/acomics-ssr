const commentClickListener = (evt) => {
	if (evt.target.tagName !== 'BUTTON') {
		return;
	}
	if (evt.target.classList.contains('comment-expand') || evt.target.classList.contains('comment-collapse')) {
		const comment = evt.target.closest('article.reader-comment');
		comment.classList.toggle('reader-comment-expanded');
	}
};

// Схлопывание длинных комментариев
const collapseLongComments = () => {
	const comments = document.querySelectorAll('article.reader-comment');
	comments.forEach((comment) => {
		const height = comment.querySelector('section.comment-text').offsetHeight;
		if (height < 350) {
			return;
		}
		comment.classList.add('reader-comment-collapsable');
		comment.addEventListener('click', commentClickListener);
	});
};
