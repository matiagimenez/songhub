import { ElementBuilder } from '../../utils/ElementBuilder.js';

const postCount = 10;

const link = ElementBuilder.createElement('link', '', {
	rel: 'stylesheet',
	href: '../scripts/components/feed/feed.css',
});
document.head.appendChild(link);

const feed = document.querySelector('section.feed');

function addLoader() {
	const lastChild = document.querySelector('section.feed article:last-child');
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

let endpoint = '';

if (window.location.href.includes('user')) {
	endpoint = '/post/profile';
} else {
	endpoint = '/post/following';
}

console.log(endpoint);

addLoader();

setTimeout(() => {
	removeLoader();
}, 5000);
