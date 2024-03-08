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
	const thumbs = document.querySelectorAll('button.thumb');
	cards[activeCardIndex].classList.remove('active');

	if (activeCardIndex > 0) {
		cards[activeCardIndex - 1].classList.add('active');
		if (thumbs.length > 0) {
			thumbs[activeCardIndex].classList.remove('active-thumb');
			thumbs[activeCardIndex - 1].classList.add('active-thumb');
		}
	} else {
		cards[cards.length - 1].classList.add('active');
		console.log(thumbs);
		if (thumbs.length > 0) {
			thumbs[activeCardIndex].classList.remove('active-thumb');
			thumbs[cards.length - 1].classList.add('active-thumb');
		}
	}
}

function nextCardChange() {
	const activeCard = getCurrentActiveCard();
	const activeCardIndex = activeCard.getAttribute('data-item-index');
	const thumbs = document.querySelectorAll('button.thumb');

	cards[activeCardIndex].classList.remove('active');
	if (activeCardIndex < cards.length - 1) {
		cards[Number(activeCardIndex) + 1].classList.add('active');
		if (thumbs.length > 0) {
			thumbs[activeCardIndex].classList.remove('active-thumb');
			thumbs[Number(activeCardIndex) + 1].classList.add('active-thumb');
		}
	} else {
		cards[0].classList.add('active');
		if (thumbs.length > 0) {
			thumbs[activeCardIndex].classList.remove('active-thumb');
			thumbs[0].classList.add('active-thumb');
		}
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
	const loader = ElementBuilder.createElement('div', '', {
		class: 'loader',
	});

	cardsContainer.appendChild(loader);
	return loader;
}

function removeLoader() {
	for (const card of cards) {
		card.classList.remove('blur');
	}
	const loader = document.querySelector('.loader');
	loader.style.display = 'none';
}

function getCurrentActiveCard() {
	return document.querySelector('.cards-container figure.active');
}

function animateCarousel() {
	removeLoader();

	for (const card of cards) {
		card.addEventListener('click', (event) => {
			const activeCard = getCurrentActiveCard();
			const activeCardIndex = activeCard.getAttribute('data-item-index');
			const thumbs = document.querySelectorAll('button.thumb');
			activeCard.classList.remove('active');
			if (thumbs.length > 0) {
				thumbs[activeCardIndex].classList.remove('active-thumb');
				thumbs[activeCardIndex].setAttribute('aria-pressed', false);
				const cardIndex = card.getAttribute('data-item-index');
				thumbs[cardIndex].classList.add('active-thumb');
				thumbs[cardIndex].setAttribute('aria-pressed', true);
			}
			card.classList.add('active');
		});
	}

	// Agrega interaccion mediante teclado
	document.addEventListener('keyup', (event) => {
		if (event.code === 'ArrowLeft') {
			previousCardChange();
		}

		if (event.code === 'ArrowRight') {
			nextCardChange();
		}
	});

	// Agrega interaccion mediante thumbs
	const thumbsContainer = ElementBuilder.createElement('div', '', {
		class: 'thumbs-container',
		role: 'group',
		'aria-label': 'Thumbs para manejar el carrusel de imágenes',
	});

	cards.forEach((_, index) => {
		const activeCard = getCurrentActiveCard();
		const activeCardIndex = activeCard.getAttribute('data-item-index');
		const thumb = ElementBuilder.createElement('button', '', {
			class: `thumb ${
				Number(activeCardIndex) === index && 'active-thumb'
			}`,
			id: index,
			'aria-label': `Ir a la imagen ${index + 1}`,
			'aria-controls': 'carousel',
			'aria-pressed': false,
		});

		thumb.addEventListener('click', (event) => {
			const id = event.target.getAttribute('id');
			const activeCard = getCurrentActiveCard();
			activeCard.classList.remove('active');
			cards[id].classList.add('active');
			const currentActiveThumb = document.querySelector('.active-thumb');
			currentActiveThumb.classList.remove('active-thumb');
			currentActiveThumb.setAttribute('aria-pressed', false);
			thumb.classList.add('active-thumb');
			thumb.setAttribute('aria-pressed', true);
		});

		thumbsContainer.appendChild(thumb);
	});

	cardsContainer.appendChild(thumbsContainer);

	// Agrega interaccion mediante botones
	const leftButton = ElementBuilder.createElement('button', '', {
		class: 'left carousel-button',
		'aria-label': 'anterior',
		'aria-controls': 'carousel',
		'aria-disabled': 'false',
	});
	const rightButton = ElementBuilder.createElement('button', '', {
		class: 'right carousel-button',
		'aria-label': 'siguiente',
		'aria-controls': 'carousel',
		'aria-disabled': 'false',
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

for (const image of images) {
	if (!image.complete) {
		image.addEventListener('load', () => {
			const progress = (100 / images.length) * loadCount;
		});
	}
}

for (const card of cards) {
	card.classList.add('blur');
}

addLoader();

// Cada 50ms verifica si las imagenes fueron cargadas
const interval = setInterval(() => {
	if (checkAllImagesLoaded()) {
		// Una vez que fueron cargadas, activa la interaccion con el carrusel
		animateCarousel();
		clearInterval(interval);
	}
}, 50);
