const menuButton = document.querySelector('.menu-button');
const menuButtonContent = document.querySelector('.menu-button i');
const menu = document.querySelector('.header-nav ul');
const body = document.body;
const main = document.querySelector('main');
const menuItems = document.querySelectorAll('.menu-item');
export var isMenuOpen = false;
const firstMenuItem = menuItems[0];
const lastMenuItem = menuItems[menuItems.length - 1];

firstMenuItem.focus();

firstMenuItem.addEventListener('keydown', (event) => {
	if (event.key === 'Tab' && event.shiftKey) {
		lastMenuItem.focus();
		event.preventDefault();
	}
});

lastMenuItem.addEventListener('keydown', (event) => {
	if (event.key === 'Tab' && !event.shiftKey) {
		firstMenuItem.focus();
		event.preventDefault();
	}
});

function updateMenuVisibility() {
	try {
		if (window.innerWidth < 900) {
			menu.classList.add('hidden');
			body.classList.remove('none-scroll');
			menu.classList.remove('view-menu');
			menu.classList.remove('close-menu');
			menuButton.setAttribute('aria-hidden', 'false');
			menuButton.setAttribute('aria-expanded', 'false');
			menu.setAttribute('aria-hidden', 'true');
			isMenuOpen = false;
			menuButton.innerHTML = `
			<i class="ph ph-list open-menu-icon"></i>
			<span class="visually-hidden">Abrir menu</span>	
		`;
			main.style.opacity = 1;
			document
				.querySelector('.header-nav ul .search-item form label')
				.classList.remove('visually-hidden');

			document
				.querySelector('.header-nav ul .logout-item button span')
				.classList.remove('visually-hidden');
		} else {
			menu.classList.remove('hidden');
			menuButton.setAttribute('aria-hidden', 'true');
			menuButton.setAttribute('aria-expanded', 'true');
			menu.setAttribute('aria-hidden', 'false');
			main.style.opacity = 1;
			isMenuOpen = true;
			document
				.querySelector('.header-nav ul .search-item form label')
				.classList.add('visually-hidden');
			document
				.querySelector('.header-nav ul li.logout-item span')
				.classList.add('visually-hidden');
		}
	} catch (error) {}
}

window.addEventListener('resize', updateMenuVisibility);

window.onload = function () {
	updateMenuVisibility();
};

document.addEventListener('click', (event) => {
	try {
		if (
			!event.target.closest('.header-nav') &&
			!event.target.closest('.menu-button')
		) {
			updateMenuVisibility();
		}

		if (
			event.target === menuButton ||
			event.target.classList.contains('open-menu-icon') ||
			event.target.classList.contains('close-menu-icon')
		) {
			if (menu.classList.contains('hidden')) {
				body.classList.add('none-scroll');
				menu.classList.remove('close-menu');
				menu.classList.remove('hidden');
				menu.classList.add('view-menu');
				isMenuOpen = true;
				menuButton.innerHTML = `
				<i class="ph-bold ph-x close-menu-icon"></i>
				<span class="visually-hidden">Cerrar menu</span>
				`;
				main.style.opacity = 0.3;
			} else {
				body.classList.remove('none-scroll');
				menu.classList.remove('view-menu');
				menu.classList.add('close-menu');
				menuButton.innerHTML = `
					<i class="ph ph-list open-menu-icon"></i>
					<span class="visually-hidden">Abrir menu</span>	
				`;
				main.style.opacity = 1;
				setTimeout(function () {
					menu.classList.add('hidden');
					isMenuOpen = false;
				}, 400);
			}

			const ariaExpandedCurrentValue =
				menuButton.getAttribute('aria-expanded');
			const ariaHiddenCurrentValue = menu.getAttribute('aria-hidden');
			menuButton.setAttribute(
				'aria-expanded',
				!JSON.parse(ariaExpandedCurrentValue)
			);
			menu.setAttribute(
				'aria-hidden',
				!JSON.parse(ariaHiddenCurrentValue)
			);

			const firstItem = document.querySelector(
				'.header-nav ul li:first-child'
			);
			firstItem.focus();
		}
	} catch (error) {}
});

document.addEventListener('keyup', (event) => {
	if (window.innerWidth < 900) {
		if (event.key === 'Escape') {
			menu.classList.remove('view-menu');
			menu.classList.add('close-menu');
			menuButton.innerHTML = `
			<i class="ph ph-list open-menu-icon"></i>
			<span class="visually-hidden">Abrir menu</span>	
			`;

			setTimeout(function () {
				menu.classList.add('hidden');
				isMenuOpen = false;
			}, 400);
			menu.setAttribute('aria-hidden', 'true');
			menuButton.setAttribute('aria-expanded', 'false');
			main.style.opacity = 1;
		}
	}
});
