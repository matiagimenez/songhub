import { ElementBuilder } from '../../utils/ElementBuilder.js';

const cardsContainer = document.querySelector('.cards-container');
const cards = document.querySelectorAll('.cards-container figure');
const images = document.querySelectorAll('.cards-container figure img');
let touchstartX = 0;
let touchendX = 0;
let loadCount = 0;

function previousCardChange() {
	const activeCard = getCurrentActiveCard();
	const activeCardIndex = activeCard.getAttribute('data-item-index');
	cards[activeCardIndex].classList.remove('active');
	if (activeCardIndex > 0) {
		cards[activeCardIndex - 1].classList.add('active');
	} else {
		cards[cards.length - 1].classList.add('active');
	}
}

function nextCardChange() {
	const activeCard = getCurrentActiveCard();
	const activeCardIndex = activeCard.getAttribute('data-item-index');
	cards[activeCardIndex].classList.remove('active');
	if (activeCardIndex < cards.length - 1) {
		cards[Number(activeCardIndex) + 1].classList.add('active');
	} else {
		cards[0].classList.add('active');
	}
}

function checkAllImagesLoaded() {
	let allLoaded = true;
	for (let i = 0; i < images.length; i++) {
		if (!images[i].complete) {
			allLoaded = false;
			return allLoaded;
		}
		if (loadCount < images.length) loadCount++;
	}
	return allLoaded;
}

function addLoader() {
	const loaderContainer = ElementBuilder.createElement('div', '', {
		class: 'loader-container',
	});

	const loader = ElementBuilder.createElement('div', '', {
		class: 'loader',
	});

	loader.style.width = '0%';
	loaderContainer.appendChild(loader);
	cardsContainer.appendChild(loaderContainer);
	return loader;
}

function removeLoader() {
	for (const card of cards) {
		card.classList.remove('blur');
	}
	const loaderContainer = document.querySelector('.loader-container');
	loaderContainer.style.display = 'none';
}

function getCurrentActiveCard() {
	return document.querySelector('.cards-container figure.active');
}

function animateCarousel() {
	removeLoader();

	for (const card of cards) {
		card.addEventListener('click', (event) => {
			const activeCard = getCurrentActiveCard();
			activeCard.classList.remove('active');
			card.classList.add('active');
		});
	}

	// Agrega interaccion mediante teclado
	document.addEventListener('keydown', (event) => {
		if (event.code === 'ArrowLeft') {
			previousCardChange();
		}

		if (event.code === 'ArrowRight') {
			nextCardChange();
		}
	});

	// Agrega interaccion mediante botones
	const leftButton = ElementBuilder.createElement('button', '', {
		class: 'left carousel-button',
	});
	const rightButton = ElementBuilder.createElement('button', '', {
		class: 'right carousel-button',
	});

	leftButton.addEventListener('click', () => previousCardChange());
	rightButton.addEventListener('click', () => nextCardChange());

	cardsContainer.appendChild(rightButton);
	cardsContainer.appendChild(leftButton);

	// Agrega interaccion mediante swipe para mobile
	cardsContainer.addEventListener('touchstart', (event) => {
		touchstartX = event.changedTouches[0].screenX;
	});

	cardsContainer.addEventListener('touchend', (event) => {
		// Funcion que determina cual fue la direccion del swipe
		const checkDirection = () => {
			if (touchendX < touchstartX) {
				nextCardChange();
			}

			if (touchendX > touchstartX) {
				previousCardChange();
			}
		};

		touchendX = event.changedTouches[0].screenX;
		checkDirection();
	});
}

const link = ElementBuilder.createElement('link', '', {
	rel: 'stylesheet',
	href: '../scripts/components/carousel/carousel.css',
});

document.head.appendChild(link);

for (const card of cards) {
	card.classList.add('blur');
}
const loader = addLoader();

for (const image of images) {
	if (!image.complete) {
		image.addEventListener('load', () => {
			loader.style.width = `${(100 / images.length) * loadCount}%`;
		});
	}
}

// Cada 50ms verifica si las imagenes fueron cargadas
const interval = setInterval(() => {
	if (checkAllImagesLoaded()) {
		// Una vez que fueron cargadas, activa la interaccion con el carrusel
		setTimeout(() => {
			animateCarousel();
		}, 2000);
		clearInterval(interval);
	}
}, 50);
