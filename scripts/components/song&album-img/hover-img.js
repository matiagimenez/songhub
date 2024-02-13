import { ElementBuilder } from "../../utils/ElementBuilder.js";

const posts = document.querySelectorAll('.post');

posts.forEach((post) => {

	const more_container = ElementBuilder.createElement('section', '', {
		class: "hidden more-container"
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
	clickImgAction(img, more_container);
});

function clickImgAction(img, more_container) {
	img.addEventListener('click', () => {
		if (window.innerWidth < 1000) {
			more_container.classList.contains('hidden') ? more_container.classList.remove('hidden') : more_container.classList.add('hidden');
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
		buttons_container.classList.add('hidden');
	});
}
