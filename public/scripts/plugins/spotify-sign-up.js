const spotifyButton = document.querySelector('.sign-up-spotify');

const registerWithSpotify = async () => {
	const response = await fetch('/spotify/authorize');
	const data = await response.json();
	console.log(data);

	// Verificar si hay una URL de redirección en el encabezado Location
	if (response.headers.has('Location')) {
		const redirectUrl = response.headers.get('Location');
		window.location.href = redirectUrl; // Redirigir al usuario a la URL obtenida
	} else {
		const data = await response.json();
		console.log(data); // Manejar la respuesta del servidor si no hay URL de redirección
	}
};

spotifyButton.addEventListener('click', () => {
	registerWithSpotify();
});
