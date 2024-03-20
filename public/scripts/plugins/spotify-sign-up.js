const spotifyButton = document.querySelector('.sign-up-spotify');

const registerWithSpotify = async () => {
	const response = await fetch('/spotify/authorize');
	const { ok, url } = await response.json();

	if (ok) {
		window.location.href = url; // Redirigir al usuario a la URL obtenida
	}
};

spotifyButton.addEventListener('click', () => {
	registerWithSpotify();
});
