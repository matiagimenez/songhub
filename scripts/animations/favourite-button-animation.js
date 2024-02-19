const heartButtons = document.querySelectorAll('.heart-button');
const heartIcon = document.querySelectorAll('.heart-icon');

heartButtons.forEach((heartButton) => {
	const heartIcon = heartButton.firstElementChild;
	heartButton.addEventListener('click', () => {
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
