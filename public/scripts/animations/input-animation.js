const inputs = document.querySelectorAll('input');
inputs.forEach((input) => {
	input.addEventListener('input', () => {
		if (input.value.trim() !== '') {
			input.classList.add('has-value');
		} else {
			input.classList.remove('has-value');
		}
	});
});
