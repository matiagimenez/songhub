const menuButton = document.querySelector('.menu-button');
const menuButtonContent = document.querySelector('.menu-button span');
const menu = document.querySelector('.header-nav ul');

function updateMenuVisibility() {
	if (window.innerWidth < 900) {
		menu.classList.add('hidden');
		menuButton.setAttribute('aria-hidden', 'false');
		menuButton.setAttribute('aria-expanded', 'false');
		menu.setAttribute('aria-hidden', 'true');
	} else {
		menu.classList.remove('hidden');
		menuButton.setAttribute('aria-hidden', 'true');
		menuButton.setAttribute('aria-expanded', 'true');
		menu.setAttribute('aria-hidden', 'false');
	}
}

window.addEventListener('resize', updateMenuVisibility);

window.onload = function () {
	updateMenuVisibility();
};

document.addEventListener('click', (event) => {
	if (event.target === menuButton || event.target === menuButtonContent) {
		menu.classList.toggle('hidden');

		const ariaExpandedCurrentValue =
			menuButton.getAttribute('aria-expanded');
		const ariaHiddenCurrentValue = menu.getAttribute('aria-hidden');
		menuButton.setAttribute(
			'aria-expanded',
			!JSON.parse(ariaExpandedCurrentValue)
		);
		menu.setAttribute('aria-hidden', !JSON.parse(ariaHiddenCurrentValue));

		const firstItem = document.querySelector(
			'.header-nav ul li:first-child'
		);
		firstItem.focus();
	}
});

document.addEventListener('keyup', (event) => {
	if (event.key === 'Escape') {
		menu.classList.add('hidden');
		menu.setAttribute('aria-hidden', 'true');
		menuButton.setAttribute('aria-expanded', 'false');
	}
});
