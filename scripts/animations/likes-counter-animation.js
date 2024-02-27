const likesContainer = document.querySelectorAll('.like-container');

likesContainer.forEach((container) => {
	container.addEventListener('click', (event) => {
		const likesCounter = container.querySelector('p');
		const heartIcon = container.querySelector('.heart-icon');
		if (heartIcon.classList.contains('active')) {
			heartIcon.classList.remove('ph-fill');
			heartIcon.classList.remove('active');
			heartIcon.classList.add('ph');
			likesCounter.textContent = parseInt(likesCounter.textContent) - 1;
		} else {
			heartIcon.classList.remove('ph');
			heartIcon.classList.add('ph-fill');
			heartIcon.classList.add('active');
			likesCounter.textContent = parseInt(likesCounter.textContent) + 1;
		}
	});
});
