document.addEventListener('click', (event) => {
	if (!event.target.classList.contains('action-button')) return;

	const currentButton = event.target;

	if (currentButton.classList.contains('submit-button')) {
		fetch('/follow/user/add', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify({ user: currentButton.id })
    })
    .then((response) => response.json())
    .catch((error) => console.error('Error:', error));
	}

	if (currentButton.classList.contains('cancel-outline-button')) {
		fetch('/unfollow/user/remove', {
      method: 'DELETE',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify({ user: currentButton.id })
    })
    .then((response) => response.json())
    .catch((error) => console.error('Error:', error));
	}
});
