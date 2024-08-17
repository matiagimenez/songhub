const button = document.querySelector('button.show-password');
const inputs = document.querySelectorAll('input.input');

if (button) {
	button.addEventListener('click', () => {
		if (!button.classList.contains('hide-password')) {
			button.classList.remove('show-password');
			button.classList.add('hide-password');
			button.innerHTML = `
				<i class='ph ph-eye icon-lg password-icon'></i>
			`;

			inputs.forEach((input) => (input.type = 'text'));
		} else {
			button.classList.remove('hide-password');
			button.classList.add('show-password');
			button.innerHTML = `
				<i class='ph ph-eye-closed icon-lg password-icon'></i>
			`;

			inputs.forEach((input) => (input.type = 'password'));
		}
	});
}
