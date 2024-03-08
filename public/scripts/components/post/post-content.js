import { ElementBuilder } from '../../utils/ElementBuilder.js';

const postContent = document.querySelectorAll('.post-content');

postContent.forEach((content) => {
	if (content.textContent.length > 200) {
		content.textContent = content.textContent.slice(0, 244) + '...';
		const postLink = ElementBuilder.createElement(
			'a',
			'Ver post completo',
			{
				href: 'post',
				class: 'read-more',
			}
		);
		content.appendChild(postLink);
	}
});
