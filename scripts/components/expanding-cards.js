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

function previousImageChange() {
	const activeCard = document.querySelector('.cards-container figure.active');
	const activeCardIndex = activeCard.getAttribute('data-item-index');
	cards[activeCardIndex].classList.remove('active');
	if (activeCardIndex > 0) {
		cards[activeCardIndex - 1].classList.add('active');
	} else {
		cards[cards.length - 1].classList.add('active');
	}
}

function nextImageChange() {
	const activeCard = document.querySelector('.cards-container figure.active');
	const activeCardIndex = activeCard.getAttribute('data-item-index');
	cards[activeCardIndex].classList.remove('active');
	if (activeCardIndex < cards.length - 1) {
		cards[Number(activeCardIndex) + 1].classList.add('active');
	} else {
		cards[0].classList.add('active');
	}
}

// Agrega interaccion mediante teclado
document.addEventListener('keydown', (event) => {
	if (event.code === 'ArrowLeft') {
		previousImageChange();
	}

	if (event.code === 'ArrowRight') {
		nextImageChange();
	}
});

// Agrega interaccion mediante swipe para mobile
let touchstartX = 0;
let touchendX = 0;

cardsContainer.addEventListener('touchstart', (event) => {
	touchstartX = event.changedTouches[0].screenX;
});

cardsContainer.addEventListener('touchend', (event) => {
	// Funcion que determina cual fue la direccion del swipe
	const checkDirection = () => {
		if (touchendX < touchstartX) {
			nextImageChange();
		}

		if (touchendX > touchstartX) {
			previousImageChange();
		}
	};

	touchendX = event.changedTouches[0].screenX;
	checkDirection();
});
