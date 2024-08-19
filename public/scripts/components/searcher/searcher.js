import { ElementBuilder } from '../../utils/ElementBuilder.js';

const searchInput = document.getElementById('search-on-page');
const form = document.getElementById('search-form');
const tracksResults = document.getElementById('tracks-results');
const albumsResults = document.getElementById('albums-results');
const profilesResults = document.getElementById('profiles-results');

const link = ElementBuilder.createElement('link', '', {
	rel: 'stylesheet',
	href: '../scripts/components/searcher/searcher.css',
});
document.head.appendChild(link);

// const exploreSection = document.querySelector(".explore-section");
const recentActivitySection = document.getElementById(
	'recent-activity-section'
);
const recommendationsSection = document.getElementById(
	'recommendations-section'
);
const favoritesSection = document.getElementById('favorites-section');
const newReleasesSection = document.getElementById('new-releases-section');
const searchResultsSection = document.getElementById('search-results-section');
const profilesResultsSection = document.getElementById(
	'profiles-results-section'
);

// Request API search content endpoint
function fetchContent(offset) {
	const loader = ElementBuilder.createElement('div', '', {
		class: 'search-loader',
	});

	tracksResults.appendChild(loader);

	fetch(`/content/search?search=${searchInput.value}&offset=${offset}`)
		.then((response) => response.json())
		.then((data) => {
			setData(data);
		})
		.catch((error) => console.error('Error:', error))
		.finally(() => {
			tracksResults.removeChild(loader);
		});
}

function fetchProfiles(offset) {
	const loader = ElementBuilder.createElement('div', '', {
		class: 'search-loader',
	});
	profilesResultsSection.appendChild(loader);

	fetch(`/user/profile/search?username=${searchInput.value}&offset=${offset}`)
		.then((response) => response.json())
		.then((data) => {
			setData(data);
		})
		.catch((error) => console.error('Error:', error))
		.finally(() => {
			profilesResultsSection.removeChild(loader);
		});
}

// Prevent Default cuando se presiona Enter
searchInput.addEventListener('keydown', function (event) {
	if (event.key === 'Enter') {
		event.preventDefault();
	}
});

form.addEventListener('submit', (event) => {
	event.preventDefault();
});

// Utiliza debounce para evitar llamadas innecesarias. Optimizando la busqueda
let debounceTimeout;
// Cada vez que cambia el input se lanza una búsqueda. Cada 300ms (Debounce)
searchInput.addEventListener('input', function () {
	clearTimeout(debounceTimeout);
	debounceTimeout = setTimeout(() => {
		searchManagement();
	}, 500);
});

function searchContent(offset) {
	if (offset == 0) {
		window.clearButtons();
		window.createPaginationButtons(1, 100);
	}
	profilesResultsSection.style.display = 'none';
	fetchContent(offset);
	searchResultsSection.style.display = 'grid';
}

function searchProfiles(offset) {
	offset == 0 && window.clearButtons();
	searchResultsSection.style.display = 'none';
	fetchProfiles(offset);
	profilesResultsSection.style.display = 'grid';
}

function searchManagement(offset = 0) {
	// Si la cadena de busqueda es mayor a 0 llamamos a la API
	if (searchInput.value.length > 0) {
		removeModalAccessClass();
		recentActivitySection.style.display = 'none';
		recommendationsSection.style.display = 'none';
		favoritesSection.style.display = 'none';
		newReleasesSection.style.display = 'none';
		window.isActiveContent ? searchContent(offset) : searchProfiles(offset);
	} else {
		// Sino, limpiamos los resultados y mostramos vista de explore
		window.isActiveContent
			? setData({ tracks: [], albums: [] })
			: setData({ users: [] });
		window.clearButtons();
		recentActivitySection.style.display = 'grid';
		recommendationsSection.style.display = 'grid';
		favoritesSection.style.display = 'grid';
		newReleasesSection.style.display = 'grid';
		searchResultsSection.style.display = 'none';
		profilesResultsSection.style.display = 'none';
	}
}

// Setea los resultados
function setData(data) {
	window.isActiveContent ? setContent(data) : setProfiles(data);
	window.scrollTo({
		top: 0,
		behavior: 'smooth',
	});
}

function setProfiles(data) {
	window.createPaginationButtons(data.current_page, data.last_page);
	profilesResults.innerHTML = '';
	profilesResults.innerHTML = '<h2 class="section-title">Perfiles</h2>';
	if (data.users.length > 0) {
		data.users.forEach((item) => {
			const article = ElementBuilder.createElement('article', '');
			article.id = item.USER_ID;
			article.innerHTML = `
			<figure>
							<a href="/user/visit?username=${item.USERNAME}">
								<section class="profile-img-container" id="${item.USER_ID}" >
										<img loading="lazy" width="180px" height="180px" src="${item.SPOTIFY_AVATAR}" alt="Foto de perfil de ${item.USERNAME}" class="profile-img blur" />
								</section>
							</a>
				<figcaption>
					<a href="/user/visit?username=${item.USERNAME}">
						<h3 class="song-title">${item.NAME}</h3>
						<h4 class="artist-title">$${item.USERNAME}</h4>
					</a>
				</figcaption>
			</figure>
		`;
			profilesResults.appendChild(article);
		});
	} else {
		if (!searchInput.value) return;

		const noResultsMessage = ElementBuilder.createElement(
			'p',
			'No se encontraron resultados en la búsqueda',
			{
				class: 'no-results-message',
			}
		);
		profilesResults.appendChild(noResultsMessage);
	}
}

function setContent(data) {
	setTracks(data.tracks);
	setAlbums(data.albums);
	const articles = searchResultsSection.querySelectorAll('.add-modal-access');
	window.applyModalListeners(articles);
	const post_form_openers = searchResultsSection.querySelectorAll('.post-form-opener');
	const create_post = searchResultsSection.querySelector('#create-post');
	window.applyPostFormListeners(post_form_openers, create_post);
	const images = searchResultsSection.querySelectorAll('.blur');
	window.addLoader(images);
}

// Setea los Tracks
function setTracks(tracks) {
	tracksResults.innerHTML = '';
	tracksResults.innerHTML = '<h2 class="section-title">Canciones</h2>';
	tracks.forEach((item) => {
		const article = document.createElement('article');
		article.className = 'add-modal-access';
		article.id = item.id;
		article.dataset.type = item.type;
		article.innerHTML = `
        <figure>
            <section class="article-img-container" id="${item.id}" data-type="${item.type}" style="background-image: url('${ item.album.images[2].url }'); background-size: cover; background-position: center;">
                <img loading="lazy" width="180px" height="180px" src="${item.album.images[0].url}" alt="Portada del ${item.type} ${item.name} del artista ${item.artists[0].name}" class="image-border blur" />
            </section>
            <figcaption>
                <a href="/content?id=${item.id}&type=${item.type}">
                    <h3 class="song-title">${item.name}</h3>
                    <h4 class="artist-title">${item.artists[0].name}</h4>
                </a>
            </figcaption>
        </figure>
    `;
		tracksResults.appendChild(article);
	});
}

// Setea los Albums
function setAlbums(albums) {
	albumsResults.innerHTML = '';
	albumsResults.innerHTML = '<h2 class="section-title">Albumes</h2>';
	albums.forEach((item) => {
		const article = document.createElement('article');
		article.className = 'add-modal-access';
		article.id = item.id;
		article.dataset.type = item.type;
		article.innerHTML = `
        <figure>
            <section class="article-img-container" id="${item.id}" data-type="${item.type}" style="background-image: url('${ item.images[2].url }'); background-size: cover; background-position: center;">
                <img loading="lazy" width="180px" height="180px" src="${item.images[0].url}" alt="Portada del ${item.type} ${item.name} del artista ${item.artists[0].name}" class="image-border blur" />
            </section>
            <figcaption>
                <a href="/content?id=${item.id}&type=${item.type}">
                    <h3 class="song-title">${item.name}</h3>
                    <h4 class="artist-title">${item.artists[0].name}</h4>
                </a>
            </figcaption>
        </figure>
    `;
		albumsResults.appendChild(article);
	});
}

function removeModalAccessClass() {
	const modalElements = document.querySelectorAll('.add-modal-access');
	modalElements.forEach((element) => {
		element.classList.remove('add-modal-access');
	});
}

window.fetchContent = fetchContent;
window.searchProfiles = searchProfiles;
window.searchManagement = searchManagement;
