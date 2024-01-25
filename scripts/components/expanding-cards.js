const cardsContainer = document.querySelector('.cards-container');
const cards = document.querySelectorAll('.cards-container figure');

for (const card of cards) {
	card.addEventListener('click', (event) => {
		const activeCard = document.querySelector(
			'.cards-container figure.active'
		);
		activeCard.classList.remove('active');
		card.classList.add('active');
	});
}
