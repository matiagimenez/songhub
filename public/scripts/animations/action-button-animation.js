document.addEventListener('mouseover', (event) => {
	if (!event.target.classList.contains('action-button')) return;

	const currentButton = event.target;
	if (currentButton.classList.contains('submit-outline-button')) {
		currentButton.classList.remove('submit-outline-button');
		currentButton.classList.add('cancel-outline-button');
		currentButton.innerText = 'Dejar de seguir';
	}
});

document.addEventListener('mouseout', (event) => {
	if (!event.target.classList.contains('action-button')) return;

	const currentButton = event.target;
	if (currentButton.classList.contains('cancel-outline-button')) {
		currentButton.classList.add('submit-outline-button');
		currentButton.classList.remove('cancel-outline-button');
		currentButton.innerText = 'Siguiendo';
	}
});

document.addEventListener('click', (event) => {
	if (!event.target.classList.contains('action-button')) return;

	const currentButton = event.target;

	if (currentButton.classList.contains('submit-button')) {
		currentButton.classList.remove('submit-button');
		currentButton.classList.add('submit-outline-button');
		currentButton.innerText = 'Siguiendo';
	}

	if (currentButton.classList.contains('cancel-outline-button')) {
		currentButton.classList.add('submit-button');
		currentButton.classList.remove('cancel-outline-button');
		currentButton.innerText = 'Seguir';
	}
});
