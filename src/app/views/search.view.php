<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Descubre una plataforma interactiva donde puedes compartir opiniones sobre música y explorar nuevas recomendaciones.
                Únete a nuestra comunidad de usuarios para escribir reviews de canciones y álbumes e interactuar con otros amantes de la música.
                ¡Explora, conecta y descubre la pasión por la música en SongHub!" />
    <meta property="og:title" content="SongHub" />
    <meta property="og:description" content="Descubre una plataforma interactiva donde puedes compartir opiniones sobre música y explorar nuevas recomendaciones.
                Únete a nuestra comunidad de usuarios para escribir reviews de canciones y álbumes e interactuar con otros amantes de la música.
                ¡Explora, conecta y descubre la pasión por la música en SongHub!" />
    <meta property="og:image"
        content="https://images.unsplash.com/photo-1485579149621-3123dd979885?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fG11c2ljfGVufDB8fDB8fHww" />
    <meta property="og:url" content="" id="og-url" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" type="image/x-icon" href="/assets/icons/favicon.svg" />
    <link rel="stylesheet" href="/styles/search.css" />
    <script src="../scripts/index.js" type="module"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <title>Búsqueda | SongHub</title>
</head>

<body>
    <header class="main-header" id="main-header">
        <?php require "fragments/header.view.php"?>
    </header>

    <main>
        <header>
            <form action="">
                <label for="search-on-page">Buscar álbum, canción o artista</label>
                <input type="search" name="search" role="searchbox" id="search-on-page" autocomplete="off" class="input"
                    aria-describedby="search-description" />
                <p id="search-description" class="visually-hidden">
                    Los resultados de la búsqueda aparecerán en un momento.
                </p>
            </form>
            <h2>Resultados de la búsqueda para <span>'P'</span></h2>
            <p>
                <input type="radio" name="category" id="all" value="all" checked />
                <label for="all">Todos</label>
                <input type="radio" name="category" id="album" value="album" />
                <label for="album">Álbum</label>
                <input type="radio" name="category" id="song" value="song" />
                <label for="song">Canción</label>
            </p>
        </header>

        <section class="section">
            <article class="add-modal-access">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy"
                            src="https://i.pinimg.com/564x/89/28/e3/8928e372651fc60256360ba5e21a7d2f.jpg"
                            alt="Portada del álbum 'Pulse' de Pink Floyd" height="140px" width="140px"
                            class="image-border" />
                    </section>
                    <figcaption>
                        <a href="song">
                            <h3 class="song-title">Pulse</h3>
                            <h4 class="artist-title">Pink Floyd</h4>

                        </a>
                    </figcaption>
                </figure>
            </article>

            <article class="add-modal-access">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy"
                            src="https://i.pinimg.com/564x/99/41/82/99418264794012ddd044c761919fbb44.jpg"
                            alt="Portada del álbum 'Punisher' de Phoebe Bridgers" height="140px" width="140px"
                            class="image-border" />
                    </section>
                    <figcaption>
                        <a href="song">
                            <h3 class="song-title">Punisher</h3>
                            <h4 class="artist-title">Phoebe Bridgers</h4>
                        </a>
                    </figcaption>
                </figure>
            </article>

            <article class="add-modal-access">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy"
                            src="https://i.pinimg.com/564x/3d/65/d5/3d65d5e4af0cde2458b2e7b55869f4e6.jpg"
                            alt="Portada de la canción 'Peso Pluma || Music Session' de Bizarrap" height="140px"
                            width="140px" class="image-border" />
                    </section>
                    <figcaption>
                        <a href="song">
                            <h3 class="song-title">Peso Pluma</h3>
                            <h4 class="artist-title">Bizarrap</h4>

                        </a>
                    </figcaption>
                </figure>
            </article>

            <article class="add-modal-access">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy"
                            src="https://i.pinimg.com/564x/28/83/60/288360836d7d5532e52012bf06981410.jpg"
                            alt="Portada de la canción 'Comfortably Numb' de Pink Floyd" height="140px" width="140px"
                            class="image-border" />
                    </section>
                    <figcaption>
                        <a href="song.html">
                            <h3 class="song-title">Comfortably Numb</h3>
                            <h4 class="artist-title">Pink Floyd</h4>

                        </a>
                    </figcaption>
                </figure>
            </article>
            <article class="add-modal-access">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy"
                            src="https://images.genius.com/1f9b73243cb9a7cd096c9107864e0638.1000x1000x1.jpg"
                            alt="Portada de la canción 'Polaris' de Saiko" height="140px" width="140px"
                            class="image-border" />
                    </section>
                    <figcaption>
                        <a href="song.html">
                            <h3 class="song-title">Polaris</h3>
                            <h4 class="artist-title">Saiko</h4>

                        </a>
                    </figcaption>
                </figure>
            </article>
            <article class="add-modal-access">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy" src="https://i.scdn.co/image/ab67616d0000b273f46b9d202509a8f7384b90de"
                            alt="Portada del album 'Purpose' de Justin Bieber" height="140px" width="140px"
                            class="image-border" />
                    </section>
                    <figcaption>
                        <a href="song.html">
                            <h3 class="song-title">Purpose</h3>
                            <h4 class="artist-title">Justin Bieber</h4>

                        </a>
                    </figcaption>
                </figure>
            </article>
            <article class="add-modal-access">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy" src="https://i.scdn.co/image/ab67616d0000b273631810af03785dbad83f5c81"
                            alt="Portada de la canción 'Paparazzi' de Lady Gaga" height="140px" width="140px"
                            class="image-border" />
                    </section>
                    <figcaption>
                        <a href="song.html">
                            <h3 class="song-title">Paparazzi</h3>
                            <h4 class="artist-title">Lady Gaga</h4>

                        </a>
                    </figcaption>
                </figure>
            </article>
        </section>
    </main>

    <footer class="main-footer">
        <?php require "fragments/footer.view.php"?>
    </footer>
</body>

</html>