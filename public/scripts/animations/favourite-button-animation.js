const favouriteButton = document.querySelector('.favourite-button');
const heartIcon = favouriteButton.querySelector('.heart-icon');

console.log(heartIcon);

favouriteButton.addEventListener('click', (event) => {
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
