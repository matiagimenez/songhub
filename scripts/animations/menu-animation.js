const menuButton = document.querySelector('.menu-button');
const menuButtonContent = document.querySelector('.menu-button i');
const menu = document.querySelector('.header-nav ul');
const body = document.body;
const main = document.querySelector('main');

function updateMenuVisibility() {
	if (window.innerWidth < 900) {
		menu.classList.add('hidden');
		body.classList.remove('none-scroll');
		menu.classList.remove('view-menu');
		menu.classList.remove('close-menu');
		menuButton.setAttribute('aria-hidden', 'false');
		menuButton.setAttribute('aria-expanded', 'false');
		menu.setAttribute('aria-hidden', 'true');
	} else {
		menu.classList.remove('hidden');
		menuButton.setAttribute('aria-hidden', 'true');
		menuButton.setAttribute('aria-expanded', 'true');
		menu.setAttribute('aria-hidden', 'false');
		main.style.opacity = 1;
	}
}

window.addEventListener('resize', updateMenuVisibility);

window.onload = function () {
	updateMenuVisibility();
};

document.addEventListener('click', (event) => {
	console.log(event.target);
	if (
		event.target === menuButton ||
		event.target.classList.contains('open-menu-icon') ||
		event.target.classList.contains('close-menu-icon')
	) {
		console.log('a');

		if (menu.classList.contains('hidden')) {
			body.classList.add('none-scroll');
			menu.classList.remove('close-menu');
			menu.classList.remove('hidden');
			menu.classList.add('view-menu');
			menuButton.innerHTML =
				'<i class="ph-bold ph-x close-menu-icon"></i>';
			main.style.opacity = 0.3;
		} else {
			body.classList.remove('none-scroll');
			menu.classList.remove('view-menu');
			menu.classList.add('close-menu');
			menuButton.innerHTML = '<i class="ph ph-list open-menu-icon"></i>';
			setTimeout(function () {
				menu.classList.add('hidden');
			}, 400);
			main.style.opacity = 1;
		}

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
	if (window.innerWidth < 900) {
		if (event.key === 'Escape') {
			menu.classList.remove('view-menu');
			menu.classList.add('close-menu');
			menuButton.innerHTML = '<i class="ph ph-list open-menu-icon"></i>';

			setTimeout(function () {
				menu.classList.add('hidden');
			}, 400);
			menu.setAttribute('aria-hidden', 'true');
			menuButton.setAttribute('aria-expanded', 'false');
			main.style.opacity = 1;
		}
	}
});
