const posts = document.querySelectorAll('.post');

posts.forEach((post) => {
	hoverImgAction(post);
});

function hoverImgAction(post) {
	const img = post.querySelector('.post-img');
	const buttons = img.querySelector('section');
	img.addEventListener('mouseover', () => {
		buttons.classList.remove('hidden');
	});
	img.addEventListener('mouseout', () => {
		buttons.classList.add('hidden');
	});
}
