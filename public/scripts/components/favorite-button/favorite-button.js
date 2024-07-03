async function getCurrentUserFavoriteContent() {
	try {
		const response = await fetch('/user/favorites');
		const data = await response.json();
		return data;
	} catch (error) {
		console.error(error);
	}
}

async function handleAddFavorite(contentId) {
	console.log(contentId);
}

async function handleRemoveFavorite(contentId) {
	console.log(contentId);
}

function isUserFavorite(albums, tracks, contentId) {
	let isFavorite = false;

	if (tracks) {
		isFavorite =
			FAVORITE_TRACKS.filter(
				(favorite) => favorite.fields['CONTENT_ID'] == contentId
			).length > 0;
	}

	if (!isFavorite && albums) {
		isFavorite =
			FAVORITE_ALBUMS.filter(
				(favorite) => favorite.fields['CONTENT_ID'] == contentId
			).length > 0;
	}

	return isFavorite;
}

const favoriteButtons = document.querySelectorAll('.favorite-button');
const { FAVORITE_ALBUMS, FAVORITE_TRACKS } =
	await getCurrentUserFavoriteContent();

favoriteButtons.forEach(async (button) => {
	const heartIcon = button.querySelector('.heart-icon');
	const contentId = button.dataset.content;

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
		if (heartIcon.classList.contains('active')) {
			handleAddFavorite(contentId);
			heartIcon.classList.remove('ph-fill');
			heartIcon.classList.remove('active');
			heartIcon.classList.add('ph');
		} else {
			heartIcon.classList.remove('ph');
			heartIcon.classList.add('ph-fill');
			heartIcon.classList.add('active');
		}
	});
});

getCurrentUserFavoriteContent();