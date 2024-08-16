const followersCount = document.querySelector('#followers-count');

document.addEventListener('click', (event) => {
	if (!event.target.classList.contains('action-button')) return;

	const currentButton = event.target;

	if (currentButton.classList.contains('follow')) {
		fetch('/follow/user?user=' + currentButton.id)
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					if (followersCount) {
						followersCount.innerText =
							parseInt(followersCount.textContent) + 1;
					}
					currentButton.classList.remove('follow');
					currentButton.classList.add('unfollow');
					currentButton.classList.remove('submit-button');
					currentButton.classList.add('submit-outline-button');
				}
			})
			.catch((error) => console.error('Error:', error));
	}

	if (currentButton.classList.contains('unfollow')) {
		fetch('/unfollow/user?user=' + currentButton.id, {
			method: 'DELETE',
			headers: {
				'Content-Type': 'application/json',
			},
			body: JSON.stringify({ user: currentButton.id }),
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					if (followersCount) {
						followersCount.innerText =
							parseInt(followersCount.textContent) - 1;
					}

					currentButton.classList.remove('unfollow');
					currentButton.classList.add('follow');
					currentButton.classList.add('submit-button');
					currentButton.innerText = 'Seguir';
					currentButton.classList.remove('submit-outline-button');
				}
			})
			.catch((error) => console.error('Error:', error));
	}
});
