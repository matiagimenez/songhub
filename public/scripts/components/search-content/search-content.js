const searchInput = document.getElementById("search-on-page");
const tracksResults = document.getElementById("tacks-results");
const albumsResults = document.getElementById("albums-results");

let debounceTimeout;

searchInput.addEventListener("input", function() {
    clearTimeout(debounceTimeout);
    const query = searchInput.value;
    debounceTimeout = setTimeout(() => {
        if (query.length > 0) {
            fetch(`/content/search?search=${query}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    setData(data);
                })
                .catch(error => console.error('Error:', error));
        }
    }, 300);
});

function setData(data) {
    setTracks(data.tracks);
    setAlbums(data.albums);
    window.applyModalListeners();
    window.applyPostFormListeners();
}

function setTracks(tracks) {
  tracksResults.innerHTML = '';
  tracksResults.innerHTML = '<h2 class="section-title">Canciones</h2>';
  tracks.forEach(item => {
    const article = document.createElement('article');
    article.className = 'add-modal-access';
    article.id = item.id;
    article.dataset.type = item.type;
    article.innerHTML = `
        <figure>
            <section class="article-img-container" id="${item.id}" data-type="${item.type}" >
                <img loading="lazy" width="180px" height="180px" src="${item.album.images[0].url}" alt="Portada del ${item.type} ${item.name} del artista ${item.artists[0].name}" class="image-border" />
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

function setAlbums(albums) {
  albumsResults.innerHTML = '';
  albumsResults.innerHTML = '<h2 class="section-title">Albumes</h2>';
  albums.forEach(item => {
    const article = document.createElement('article');
    article.className = 'add-modal-access';
    article.id = item.id;
    article.dataset.type = item.type;
    article.innerHTML = `
        <figure>
            <section class="article-img-container" id="${item.id}" data-type="${item.type}" >
                <img loading="lazy" width="180px" height="180px" src="${item.images[0].url}" alt="Portada del ${item.type} ${item.name} del artista ${item.artists[0].name}" class="image-border" />
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