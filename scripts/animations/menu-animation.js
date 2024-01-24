const menuButton = document.querySelector('.menu-button');
const menuButtonContent = document.querySelector('.menu-button span');
const nav = document.querySelector('.header-nav ul');

document.addEventListener('click', (event) => {
	if (event.target === menuButton || event.target === menuButtonContent) {
		nav.classList.toggle('hidden');

		const ariaCurrentValue = menuButton.getAttribute('aria-expanded');
		menuButton.setAttribute('aria-expanded', !JSON.parse(ariaCurrentValue));

		const firstItem = document.querySelector(
			'.header-nav ul li:first-child'
		);
		firstItem.focus();
	}
});

document.addEventListener('keyup', (event) => {
	if (event.key === 'Escape') {
		nav.classList.add('hidden');
	}
});
