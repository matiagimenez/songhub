import { ElementBuilder } from "../../utils/ElementBuilder.js";

const posts = document.querySelectorAll('.post');

posts.forEach((post) => {

	const more_container = ElementBuilder.createElement('section', '', {
		class: "more-container"
	})
	const more_button = ElementBuilder.createElement('button', '...', {
		class: "more-button"
	})
	more_container.appendChild(more_button)

	const buttons_container = ElementBuilder.createElement('section', '', {
		class: "hidden buttons-container"
	})
	const view_song = ElementBuilder.createElement('a', '', {
		href: "/views/song.html"
	})
	const create_post = ElementBuilder.createElement('button', '', {
		class: "post-form-opener"
	})
	buttons_container.appendChild(view_song)
	buttons_container.appendChild(create_post)
	const img = post.querySelector('.post-img');
	img.appendChild(more_container);
	img.appendChild(buttons_container);
	hoverImgAction(img, buttons_container);
	clickImgAction(buttons_container, more_button);
});

function clickImgAction(buttons_container, more_button) {
	more_button.addEventListener('click', () => {
		if (window.innerWidth < 1000) {
			buttons_container.classList.contains('hidden') ? buttons_container.classList.remove('hidden') : buttons_container.classList.add('hidden');
		}
	})
}

function hoverImgAction(img, buttons_container) {
	img.addEventListener('mouseover', () => {
		if (window.innerWidth >= 1000) {
			buttons_container.classList.remove('hidden');
		}
	});
	img.addEventListener('mouseout', () => {
		if (window.innerWidth >= 1000) {
			buttons_container.classList.add('hidden');
		}
	});
}
