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

	if (like_button.classList.contains('like')) {
		like_button.classList.remove('like');
		like_button.classList.add('unlike');
		updateLikeCounter(like_counter, false);
	} else {
		like_button.classList.remove('unlike');
		like_button.classList.add('like');
		updateLikeCounter(like_counter, true);
	}
}

function updateLikeCounter(like_counter, inc_action) {
	let likes = parseInt(like_counter.textContent);
	inc_action ? (likes += 1) : (likes -= 1);
	like_counter.textContent = likes;
}
