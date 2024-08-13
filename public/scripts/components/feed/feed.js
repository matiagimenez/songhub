import { ElementBuilder } from '../../utils/ElementBuilder.js';

let postCount = 10;
let totalPosts = 10;
let currentPage = 0;
let endOfTheFeed = false;

const link = ElementBuilder.createElement('link', '', {
	rel: 'stylesheet',
	href: '../scripts/components/feed/feed.css',
});
document.head.appendChild(link);

const feed = document.querySelector('section.feed');

// Evento para detectar cuando el usuario llega al final del feed
window.addEventListener('scroll', () => {
	function addLoader() {
		const lastChild = document.querySelector(
			'section.feed article:last-child'
		);
		lastChild.classList.add('no-border');

		const loader = ElementBuilder.createElement('div', '', {
			class: 'feed-loader',
		});

		lastChild.appendChild(loader);
	}

	function removeLoader() {
		const lastChild = document.querySelector('article.no-border');
		lastChild.classList.remove('no-border');

		const loader = document.querySelector('div.feed-loader');
		lastChild.removeChild(loader);
	}

	async function fetchPosts() {
		let endpoint = '';

		if (window.location.href.includes('user')) {
			endpoint = '/post/profile';
		} else {
			endpoint = '/post/following';
		}

		if (!endpoint) return;

		console.log(`Fetching posts to ${endpoint}...`);
		feed.setAttribute('aria-busy', true);

		try {
			const response = await fetch(`${endpoint}?page=${currentPage + 1}`);
			const data = await response.json();

			// removeLoader();

			if (data.length === 0) {
				feed.setAttribute('aria-busy', false);
				endOfTheFeed = true;
				return;
			}

			currentPage++;
			totalPosts += data.length;

			data.map((post) => {
				postCount++;
				const type = post.TYPE == 't' ? 'track' : 'album';

				const postElement = ElementBuilder.createElement(
					'article',
					'',
					{
						class: 'post add-modal-access',
						tabindex: 0,
						id: `post-${post.POST_ID}`,
						'aria-posinset': `${postCount}`,
						'aria-setsize': `${totalPosts}`,
						'aria-labelledby': `post-${post.POST_ID}-song-title post-${post.POST_ID}-artist-title`,
						'aria-describedby': `post-content-${post.POST_ID}`,
					}
				);

				const tagElements = post.TAGS.map(
					(tag) => `<span class="tag">${tag.TEXT}</span>`
				).join(' ');

				const starElements = Array.from({ length: 5 }, (_, i) =>
					i < post.RATING ? '★' : '☆'
				).join('');

				postElement.innerHTML = `
					 <figure>
                        <section class="article-img-container">
                            <img loading="lazy" class="image-border" width="100px" height="100px" src="${post.COVER_ID}" alt="Portada del álbum '${post.TITLE}' ${post.NAME}" />
                        </section>
                        <section class="user-info">
                            <img loading="lazy" class="user-img" height="25px" width="25px" src="${post.USER.fields.SPOTIFY_AVATAR}" alt="Imagen de perfil de '{{ post.USER.fields.USERNAME }}'" />
                            <p class="user-name">
                            	<a href="/user?username=${post.USER.fields.USERNAME}">${post.USER.fields.NAME}</a>
                                <span>$${post.USER.fields.USERNAME}</span>
                            </p>
                            <p class="post-time">${post.TIME_AGO}</p>
                        </section>
                        <figcaption>
                            <h3 class="song-title" id="post-${post.POST_ID}-song-title">
                                <a href="/content?id=${post.CONTENT_ID}&type=${type}">${post.TITLE}</a>
                            </h3>
                            <h4 class="artist-title" id="post-${post.POST_ID}-artist-title">${post.NAME}</h4>
                            ${tagElements}
                            <p class="stars">
                                ${starElements}
                            </p>
                        </figcaption>
                    </figure>
					<a href="/post?id=${post.POST_ID}">
                        <section class="post-content" id="post-content-${post.POST_ID}">
                        	<p>${post.DESCRIPTION}</p>
                        </section>
                    </a>
                    <footer>
                        <section class="reaction-container comment-container">
                            <a href="/post?id=${post.POST_ID}">
                                <i class="ph ph-chats-circle icon comment-icon"></i>
                                <span class="visually-hidden">Comentar post</span>
                            </a>
                        </section>
                        <section class="reaction-container like-container">
                            <button class="heart-button">
                                <i class="ph ph-heart icon heart-icon"></i>
                                <span class="visually-hidden">Dar favorito al post</span>
                            </button>
                            <p>${post.LIKES}</p>
                        </section>
                    </footer>
					`;

				feed.appendChild(postElement);
			});

			const posts = document.querySelectorAll('article.post');
			posts.forEach((post) => {
				post.setAttribute('aria-setsize', totalPosts);
			});

			feed.setAttribute('aria-busy', false);
		} catch (error) {
			console.error(error);
		}
	}

	const scrollPosition = window.scrollY + window.innerHeight;
	const totalHeight = document.documentElement.scrollHeight;
	const isLoading = document.querySelector('div.feed-loader');

	// Verifico si el scroll está en el final de página
	if (scrollPosition >= totalHeight && !isLoading) {
		console.log('Reached the bottom of the page');

		if (endOfTheFeed) return;

		addLoader();
		fetchPosts();
	}
});
