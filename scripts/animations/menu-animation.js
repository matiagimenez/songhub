const menuButton = document.querySelector('.menu-button');
const menuButtonContent = document.querySelector('.menu-button span');
const nav = document.querySelector('.header-nav ul');

window.addEventListener('resize', () => {
	if (window.innerWidth < 900) {
		nav.classList.add('hidden');
		menuButton.setAttribute('aria-hidden', 'false');
		menuButton.setAttribute('aria-expanded', 'false');
	} else {
		menuButton.setAttribute('aria-hidden', 'true');
		nav.setAttribute('aria-hidden', 'false');
	}
});

document.addEventListener('click', (event) => {
	if (event.target === menuButton || event.target === menuButtonContent) {
		nav.classList.toggle('hidden');

		const ariaExpandedCurrentValue =
			menuButton.getAttribute('aria-expanded');
		const ariaHiddenCurrentValue = nav.getAttribute('aria-hidden');
		menuButton.setAttribute(
			'aria-expanded',
			!JSON.parse(ariaExpandedCurrentValue)
		);
		nav.setAttribute('aria-hidden', !JSON.parse(ariaHiddenCurrentValue));

		const firstItem = document.querySelector(
			'.header-nav ul li:first-child'
		);
		firstItem.focus();
	}
});

document.addEventListener('keyup', (event) => {
	if (event.key === 'Escape') {
		nav.classList.add('hidden');
		nav.setAttribute('aria-hidden', 'true');
		menuButton.setAttribute('aria-expanded', 'false');
	}
});
