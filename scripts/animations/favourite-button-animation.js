const heartButton = document.querySelector('.heart-button');
const heartIcon = document.querySelector('.heart-icon');

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
