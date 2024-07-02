const favoriteButtons = document.querySelectorAll('.favorite-button');

favoriteButtons.forEach((button) => {
	const heartIcon = button.querySelector('.heart-icon');
	button.addEventListener('click', (event) => {
		if (heartIcon.classList.contains('active')) {
			heartIcon.classList.remove('ph-fill');
			heartIcon.classList.remove('active');
			heartIcon.classList.add('ph');
		} else {
			heartIcon.classList.remove('ph');
			heartIcon.classList.add('ph-fill');
			heartIcon.classList.add('active');
		}
	});
});
