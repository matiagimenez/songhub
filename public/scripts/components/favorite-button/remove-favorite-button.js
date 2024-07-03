const removeFavoriteButtons = document.querySelectorAll(
	'button.remove-favorite'
);

removeFavoriteButtons.forEach(async (button) => {
	const contentId = button.dataset.content;

	button.addEventListener('click', async () => {
		try {
			await fetch(`/user/favorites/remove?id=${contentId}`);

			window.location.replace(`/user/profile`);
		} catch (error) {
			console.log(error);
			window.location.replace('/error/internal-error');
		}
	});
});
