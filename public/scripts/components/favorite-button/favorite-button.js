async function getCurrentUserFavoriteContent() {
	try {
		const response = await fetch('/user/favorites');
		const data = await response.json();
		return data;
	} catch (error) {
		window.location.replace('/error/internal-error');
	}
}

async function handleAddFavorite(contentId, contentType, username) {
	try {
		await fetch(`/content/data?id=${contentId}&type=${contentType}`);

		await fetch(`/user/favorites/add?id=${contentId}&type=${contentType}`);

		window.location.replace(`/user?username=${username}`);
	} catch (error) {
		console.error(error);
		window.location.replace('/error/internal-error');
	}
}

function isUserFavorite(albums, tracks, contentId) {
	let isFavorite = false;

	if (tracks) {
		isFavorite =
			tracks.filter(
				(favorite) => favorite.fields['CONTENT_ID'] == contentId
			).length > 0;
	}

	if (!isFavorite && albums) {
		isFavorite =
			albums.filter(
				(favorite) => favorite.fields['CONTENT_ID'] == contentId
			).length > 0;
	}

	return isFavorite;
}

setTimeout(async () => {
	const favoriteButtons = document.querySelectorAll(
		'button.toggle-favorite-content'
	);

	const { FAVORITE_ALBUMS, FAVORITE_TRACKS } =
		await getCurrentUserFavoriteContent();

	favoriteButtons.forEach(async (button) => {
		const heartIcon = button.querySelector('.heart-icon');
		const contentId = button.dataset.content;
		const contentType = button.dataset.type;
		const username = button.dataset.username;

		const isFavorite = isUserFavorite(
			FAVORITE_ALBUMS,
			FAVORITE_TRACKS,
			contentId
		);

		if (isFavorite) {
			heartIcon.classList.add('ph-fill');
			heartIcon.classList.add('active');
		}

		button.addEventListener('click', (event) => {
			if (!heartIcon.classList.contains('active')) {
				if (!heartIcon.classList.contains('favorite-disabled')) {
					handleAddFavorite(contentId, contentType, username);
					heartIcon.classList.remove('ph');
					heartIcon.classList.add('ph-fill');
					heartIcon.classList.add('active');
				}
			}
		});
	});
}, 500);
