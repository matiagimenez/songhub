const favouriteSongs = document.querySelectorAll(
	'.edit-favourites section figure'
);

favouriteSongs.forEach((song) => {
	song.addEventListener('mouseenter', () => {
		song.classList.add('remove-favourite');
	});

	song.addEventListener('mouseleave', () => {
		song.classList.remove('remove-favourite');
	});
});
