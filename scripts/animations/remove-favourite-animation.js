const favouriteSongs = document.querySelectorAll(
	'.edit-favourites section figure'
);

window.addEventListener('resize', () => {
	if (window.innerWidth < 900) {
		favouriteSongs.forEach((song) => {
			song.classList.add('remove-favourite');
		});
	} else {
		favouriteSongs.forEach((song) => {
			song.classList.remove('remove-favourite');
			song.addEventListener('mouseenter', () => {
				song.classList.add('remove-favourite');
			});

			song.addEventListener('mouseleave', () => {
				song.classList.remove('remove-favourite');
			});
		});
	}
});
