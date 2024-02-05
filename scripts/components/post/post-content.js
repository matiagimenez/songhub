import { ElementBuilder } from '../../utils/ElementBuilder.js';

const postContent = document.querySelector('.post-content');

if (postContent.textContent.length > 200) {
	postContent.textContent = postContent.textContent.slice(0, 244) + '...';
	const postLink = ElementBuilder.createElement('a', 'Ver post completo', {
		href: 'post.html',
		class: 'read-more',
	});
	postContent.appendChild(postLink);
}
