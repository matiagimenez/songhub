import { ElementBuilder } from '../../utils/ElementBuilder.js';

const postCount = 10;

const link = ElementBuilder.createElement('link', '', {
	rel: 'stylesheet',
	href: '../scripts/components/feed/feed.css',
});
document.head.appendChild(link);

const feed = document.querySelector('section.feed');
let endpoint = '';

if (window.location.href.includes('user')) {
	endpoint = '/post/profile';
} else {
	endpoint = '/post/following';
}

// Evento para detectar cuando el usuario llega al final del feed
window.addEventListener('scroll', () => {
	function addLoader() {
		const lastChild = document.querySelector(
			'section.feed article:last-child'
		);
		lastChild.classList.add('no-border');

		const loader = ElementBuilder.createElement('div', '', {
			class: 'feed-loader',
		});

		lastChild.appendChild(loader);
	}

	function removeLoader() {
		const lastChild = document.querySelector('article.no-border');
		lastChild.classList.remove('no-border');

		const loader = document.querySelector('div.feed-loader');
		lastChild.removeChild(loader);
	}

	async function fetchPosts() {
		console.log(`Fetching posts to ${endpoint}`);

		setTimeout(() => {
			removeLoader();
		}, 5000);
	}

	const scrollPosition = window.scrollY + window.innerHeight;
	const totalHeight = document.documentElement.scrollHeight;
	const isLoading = document.querySelector('div.feed-loader');

	// Verifico si el scroll está en el final de página
	if (scrollPosition >= totalHeight && !isLoading) {
		console.log('Reached the bottom of the page');
		addLoader();
		// TODO: fetch data for rendering new posts
		fetchPosts();
	}
});
