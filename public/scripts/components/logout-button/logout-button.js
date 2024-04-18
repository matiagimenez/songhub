const logout_button = document.querySelector('.logout-button');

logout_button.addEventListener('click', (event) => {
	fetch('http://localhost:8888/logout').then(window.location.reload());
});
