document.addEventListener('click', (event) => {
    console.log('a');
    if (!event.target.classList.contains('action-button')) return;
    console.log('b');
    
	const currentButton = event.target;
    
	if (currentButton.classList.contains('submit-button')) {
        
        fetch('/follow/user/add?user='+currentButton.id)
        .then((response) => response.json())
        .then((data) => {
            console.log('Success:', data);
        })
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
