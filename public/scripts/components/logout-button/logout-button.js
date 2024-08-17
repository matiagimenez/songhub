const logout_button = document.querySelector('.logout-button');

if (logout_button) {
	logout_button.addEventListener('click', (event) => {
		fetch('/logout').then(window.location.replace('/login'));
	});
}
