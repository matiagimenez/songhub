import { ElementBuilder } from '../../utils/ElementBuilder.js';

const link = ElementBuilder.createElement('link', '', {
	rel: 'stylesheet',
	href: '../scripts/components/share-menu/share-menu.css',
});
document.head.appendChild(link);

const shareButtons = document.querySelectorAll('.share-button');

shareButtons.forEach((button) => {
	const shareMenu = ElementBuilder.createElement('div', '', {
		class: 'share-menu',
	});
	const copyToClipboardItem = ElementBuilder.createElement(
		'button',
		'Copiar link',
		{ class: 'share-menu-item' }
	);
	const createTweetItem = ElementBuilder.createElement(
		'button',
		'Compartir en twitter',
		{ class: 'share-menu-item' }
	);
	shareMenu.appendChild(copyToClipboardItem);
	shareMenu.appendChild(createTweetItem);
	button.appendChild(shareMenu);

	button.addEventListener('click', (event) => {
		shareMenu.classList.toggle('open');
		const postId = button.getAttribute('data-post-id');
		const postLink = `http://localhost:3000/post.html?id=${postId}`;
	});
});
