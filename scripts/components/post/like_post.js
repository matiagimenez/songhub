const posts = document.querySelectorAll('.post');

posts.forEach((post) => {
	const like_button = post.querySelector('.like-container button');
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
		icon.src = './../assets/icons/post-icons/star.svg';
		icon.id = 'unlike_star';
		updateLikeCounter(like_counter, false);
	}
}

function updateLikeCounter(like_counter, inc_action) {
	let likes = parseInt(like_counter.textContent);
	inc_action ? (likes += 1) : (likes -= 1);
	like_counter.textContent = likes;
}
