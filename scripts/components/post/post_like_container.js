import { ElementBuilder } from '../../utils/ElementBuilder.js';
const posts = document.querySelectorAll('.post');

const darkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
let star_icon = './../assets/icons/post-icons/star.svg';
darkMode && (star_icon = './../assets/icons/post-icons/dark_mode_star.svg');

posts.forEach((post) => {
	const like_button = post.querySelector('.like-container button');
	const star_img = ElementBuilder.createElement('img', '', {
		src: star_icon,
		alt: "like",
		width: "20px",
		id: "unlike_star",
	});
	like_button.appendChild(star_img);
	like_button.addEventListener('click', () => {
		toggleImg(post.id);
	});
});

function toggleImg(post_id) {
	console.log(post_id);
	const post = document.getElementById(post_id);
	const like_section = post.querySelector('.like-container');
	const like_button = like_section.querySelector('button');
	const like_counter = like_section.querySelector('p');
	const icon = like_button.querySelector('img');

	if (icon.id === 'unlike_star') {
		icon.src = './../assets/icons/post-icons/yellow_star.svg';
		icon.id = 'like_star';
		updateLikeCounter(like_counter, true);
	} else {
		icon.src = star_icon;
		icon.id = 'unlike_star';
		updateLikeCounter(like_counter, false);
	}
}

function updateLikeCounter(like_counter, inc_action) {
	let likes = parseInt(like_counter.textContent);
	inc_action ? (likes += 1) : (likes -= 1);
	like_counter.textContent = likes;
}
