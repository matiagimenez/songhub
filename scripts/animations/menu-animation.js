const menuButton = document.querySelector('.menu-button');
const menuButtonContent = document.querySelector('.menu-button span');
const menu = document.querySelector('.header-nav ul');
const body = document.body;

function updateMenuVisibility() {
	if (window.innerWidth < 900) {
		menu.classList.add('hidden')
		body.classList.remove('none-scroll')
		menu.classList.remove('view-menu')
		menu.classList.remove('close-menu')
		menuButton.classList.remove('close-menu-button')
		menuButton.classList.add('open-menu-button')
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
		if (menu.classList.contains('hidden')) {
			body.classList.add('none-scroll')
			menu.classList.remove('close-menu')
			menu.classList.remove('hidden')
			menu.classList.add('view-menu')
			menuButton.classList.remove('open-menu-button')
			menuButton.classList.add('close-menu-button')
		} else {
			body.classList.remove('none-scroll')
			menu.classList.remove('view-menu')
			menu.classList.add('close-menu')
			menuButton.classList.remove('close-menu-button')
			menuButton.classList.add('open-menu-button')
			setTimeout(function () {
				menu.classList.add('hidden')
			}, 400);
		}

		/*const ariaExpandedCurrentValue =
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
		firstItem.focus();*/
	}
});

document.addEventListener('keyup', (event) => {
	if (event.key === 'Escape') {
		menu.classList.remove('view-menu')
		menu.classList.add('close-menu')
		menuButton.classList.remove('close-menu-button')
		menuButton.classList.add('open-menu-button')
		setTimeout(function () {
			menu.classList.add('hidden')
		}, 400);
		menu.setAttribute('aria-hidden', 'true');
		menuButton.setAttribute('aria-expanded', 'false');
	}
});
