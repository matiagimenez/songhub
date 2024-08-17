import { ElementBuilder } from '../../utils/ElementBuilder.js';

let usersCount = document.querySelectorAll('section.users article.user').length;
let totalUsers = document.querySelectorAll('section.users article.user').length;
let currentPage = 0;
let endOfTheList = false;
const urlParams = new URLSearchParams(window.location.search);
const currentUser = urlParams.get('username');

const link = ElementBuilder.createElement('link', '', {
	rel: 'stylesheet',
	href: '../scripts/components/follow-list/follow-list.css',
});
document.head.appendChild(link);

const users = document.querySelector('section.users');

// Evento para detectar cuando el usuario llega al final del feed
window.addEventListener('scroll', () => {
	function addLoader() {
		const loader = ElementBuilder.createElement('div', '', {
			class: 'list-loader',
		});

		users.appendChild(loader);
	}

	function removeLoader() {
		const loader = document.querySelector('div.list-loader');
		users.removeChild(loader);
	}

	async function fetchUsers() {
		let endpoint = '';

		if (window.location.href.includes('followers')) {
			endpoint = '/followers';
		} else {
			endpoint = '/following';
		}

		if (!endpoint) return;

		users.setAttribute('aria-busy', true);

		try {
			const response = await fetch(
				`${endpoint}?username=${currentUser}&page=${currentPage + 1}`
			);

			const { data, username } = await response.json();

			removeLoader();

			if (data.length === 0) {
				users.setAttribute('aria-busy', false);
				endOfTheList = true;
				return;
			}

			currentPage++;
			totalUsers += data.length;

			data.map((user) => {
				usersCount++;

				const userElement = ElementBuilder.createElement(
					'article',
					'',
					{
						class: 'user',
						tabindex: 0,
						'aria-posinset': `${usersCount}`,
						'aria-setsize': `${totalUsers}`,
					}
				);

				let userElementContent = `
					<img loading="lazy" height="70px" width="70px" src="${user.SPOTIFY_AVATAR}" alt="Imagen de perfil de ${user.USERNAME}" />
					<a href="/user?username=${user.USERNAME}">${user.NAME} <span>${user.USERNAME}</span></a>
					<p>
						${user.BIOGRAPHY}
					</p>
				`;

				if (user.USERNAME !== username) {
					if (user.FOLLOWING) {
						userElementContent += `<button id="${user.USER_ID}" class="action-button submit-outline-button unfollow">Siguiendo</button>`;
					} else {
						userElementContent += `<button id="${user.USER_ID}" class="submit-button action-button follow">Seguir</button>`;
					}
				}

				userElement.innerHTML = userElementContent;

				users.appendChild(userElement);
			});

			const userElements = document.querySelectorAll('article.user');
			userElements.forEach((user) => {
				user.setAttribute('aria-setsize', totalUsers);
			});

			users.setAttribute('aria-busy', false);
		} catch (error) {
			console.error(error);
		}
	}

	const scrollPosition = Math.ceil(window.scrollY + window.innerHeight);
	/* Si el usuario se encuentra en los últimos 50px de página, se dispara la recarga */
	const totalHeight = document.documentElement.scrollHeight - 50;
	const isLoading = document.querySelector('div.list-loader');

	// Verifico si el scroll está en el final de página
	if (scrollPosition >= totalHeight && !isLoading) {
		if (endOfTheList) return;

		addLoader();
		fetchUsers();
	}
});
