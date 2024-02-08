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
		role: 'menu',
	});

	const copyToClipboardItem = ElementBuilder.createElement(
		'button',
		'Copiar link',
		{ class: 'share-menu-item copy', role: 'menuitem', tabindex: '0' }
	);

	const createTweetItem = ElementBuilder.createElement(
		'button',
		'Compartir en Twitter',
		{ class: 'share-menu-item twitter', role: 'menuitem', tabindex: '0' }
	);

	copyToClipboardItem.addEventListener('click', (event) => {
		const postId = button.getAttribute('data-post-id');
		// const currentUrl = window.location.href;
		// navigator.clipboard.writeText(currentUrl);
		const postLink = `http://localhost:3000/post.html?id=${postId}`;
		navigator.clipboard.writeText(postLink);

		const popUp = ElementBuilder.createElement('div', 'Link copiado', {
			class: 'popup',
		});
		button.appendChild(popUp);
		setTimeout(() => {
			button.removeChild(popUp);
		}, 1200);
	});

	createTweetItem.addEventListener('click', (event) => {
		const postId = button.getAttribute('data-post-id');
		const postContent = button.getAttribute('data-post-content');

		const postLink = `http://localhost:3000/post.html?id=${postId}`;
		const tweet = `Te puede interesar mi post sobre "${postContent}" en Songhub: 
						${postLink}`;
		const tweetUrl = `https://twitter.com/intent/tweet?text=${tweet}`;
		window.open(tweetUrl, '_blank');
	});

	shareMenu.appendChild(copyToClipboardItem);
	shareMenu.appendChild(createTweetItem);
	button.appendChild(shareMenu);

	button.addEventListener('click', (event) => {
		shareMenu.classList.toggle('open');
		const postId = button.getAttribute('data-post-id');
		const postLink = `http://localhost:3000/post.html?id=${postId}`;
	});
});
