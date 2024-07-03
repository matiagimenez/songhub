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
    <link rel="stylesheet" href="../styles/content.css" />
    <script src="../scripts/index.js" type="module"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <title>Canción | SongHub</title>
</head>

<body>
    <header class="main-header" id="main-header">
        <?php require "fragments/header.view.php"?>
    </header>
    <main>
        <section class="song-section">
            <figure>
                <img src=<?= $content["images"][1]["url"] ?>
                    alt="<?= "Portada del " . $content["type"] . " " . $content["album_name"] . " de " . $content["artist_name"] ?>" width="225px" height="225px"
                    class="image-border" />
                <figcaption>
                    <?php if ($content["type"] == "track"): ?>
                        <p>Canción</p>
                        <h2><?= $content["track_name"] ?></h2>
                        <h3><?= $content["album_name"] ?></h3>
                    <?php else: ?> 
                        <p>Álbum</p>
                        <h2><?= $content["album_name"] ?></h2>
                    <?php endif; ?> 
                    <p class="artist-info">
                        <img src=<?= $content["artist_avatar_url"] ?> alt="<?= "Imagen de perfil de " . $content["artist_name"] ?>" height="55px" width="55px" />
                        <a href=<?= $content["artist_spotify_url"] ?> target="_blank"><?= $content["artist_name"] ?> · <?= explode("-", $content["release_date"])[0] ?></a>
                    </p>
                </figcaption>
            </figure>
            <section class="song-stats">
                <h2>Valoración</h2>
                <p class="posts-amount">10k posts</p>
                <p class="qualification">
                    <span class="stars">★★★★★</span>
                    <span class="number">4.2</span>
                </p>
            </section>
            <section class="song-actions">
                <?php if ($content["type"] == "track"): ?>
                    <button class="submit-button post-form-opener" id=<?= $content["track_id"] ?> data-type=<?= $content["type"] ?> >Crear post</button>
                <?php else: ?> 
                    <button class="submit-button post-form-opener" id=<?= $content["album_id"] ?> data-type=<?= $content["type"] ?> >Crear post</button>
                <?php endif; ?> 
                <section>
                    <button class="favorite-button">
                        <i class="ph ph-heart icon heart-icon"></i>
                        <span class="visually-hidden">
                            Agregar canción/álbum como favorita
                        </span>
                    </button>
                    <?php if ($content["type"] == "track"): ?>
                        <a class="spotify-button" href=<?= $content["track_spotify_url"] ?> target="_blank">
                            <i class="ph ph-spotify-logo icon-lg spotify-icon"></i>
                            <span class="visually-hidden">
                                Ver en spotify
                            </span>
                        </a>
                    <?php else: ?> 
                        <a class="spotify-button" href=<?= $content["album_spotify_url"] ?> target="_blank">
                            <i class="ph ph-spotify-logo icon-lg spotify-icon"></i>
                            <span class="visually-hidden">
                                Ver en spotify
                            </span>
                        </a>
                    <?php endif; ?> 
                    <?php if ($content["type"] == "track"): ?>
                        <button class="track-preview-button">
                            <i class="ph ph-play-circle icon-lg play-icon"></i>
                            <span class="visually-hidden">
                                Reproducir pre-escucha de la canción
                            </span>
                        </button>
                        <audio class="track-preview">
                            <source src=<?= $content["track_preview_url"]?> type="audio/mp3">
                            Tu navegador no soporta la etiqueta de audio.
                        </audio>
                    <?php endif; ?> 
                    <?php if ($content["type"] == "track"): ?>
                        <button class="share-button" data-song-id=<?= $content["track_id"] ?> data-post-content="<?= $content["track_name"] . " de " . $content["artist_name"] ?>" >
                            <i class="ph ph-share-network icon share-icon"></i>
                            <span class="visually-hidden">
                                Compartir información de la canción
                            </span>
                        </button>
                    <?php else: ?> 
                        <button class="share-button" data-song-id=<?= $content["album_id"] ?> data-post-content="<?= $content["album_name"] . " de " . $content["artist_name"] ?>" >
                            <i class="ph ph-share-network icon share-icon"></i>
                            <span class="visually-hidden">
                                Compartir información del álbum
                            </span>
                        </button>
                    <?php endif; ?> 
                </section>
            </section>
        </section>
        <section class="most-popular-posts">
            <h2 class="section-title">Publicaciones más populares</h2>
            <section>
                <?php if (count($mostRelevantPosts) == 0): ?>
                    <p class="no-content-msg">No hay ningún post relacionado a este contenido</p>
                <?php else: ?> 
                    <article tabindex="0" class="post add-modal-access" id="post_1" aria-posinset="1" aria-setsize="3" aria-labelledby="post-1-song-title post-1-artist-title" aria-describedby="post-content-1">
                        <figure>
                            <section class="article-img-container">
                                <img loading="lazy" class="image-border" width="100px" height="100px"
                                    src="https://i.pinimg.com/564x/2f/18/9e/2f189e3be4ef04ab12a0a125efe4e67e.jpg"
                                    alt="Portada del álbum 'Dark Side of The Moon' Pink Floyd" />
                            </section>
                            <section class="user-info">
                                <img loading="lazy" class="user-img" height="25px" width="25px"
                                    src="https://i.pinimg.com/236x/94/7f/14/947f14841d26f5dc3541366a987b32f5.jpg"
                                    alt="Imagen de perfil de 'Usuario 1'" />
                                <p class="user-name">
                                    <a href="profile.html">Usuario 1</a>
                                    <span>$username1</span>
                                </p>
                                <p class="post-time">hace 8 horas</p>
                            </section>
                            <figcaption>
                                <h3 class="song-title" id="post-1-song-title">
                                    <a href="song.html">The Dark Side of the Moon</a>
                                </h3>
                                <h4 class="artist-title" id="post-1-artist-title">
                                    Pink Floyd
                                </h4>
                                <span class="tag">Increible</span>
                                <span class="tag">Rock</span>
                                <span class="tag">Internacional</span>
                                <p class="stars">★★★★★</p>
                            </figcaption>
                        </figure>
                        <section class="post-content" id="post-content-1">
                                <a href="post.html">
                                    <p>
                                        It has survived not only five centuries, but
                                        also the leap into electronic typesetting,
                                        remaining essentially unchanged. It was
                                        popularised in the 1960s with the release of
                                        Letraset sheets containing Lorem Ipsum
                                        passages, and more recently with desktop
                                        publishing software like Aldus PageMaker
                                        including versions of Lorem Ipsum. t has
                                        survived not only five centuries, but also
                                        the leap into electronic typesetting,
                                        remaining essentially unchanged. It was
                                        popularised in the 1960s with the release of
                                        Letraset sheets containing Lorem Ipsum
                                        passages, and more recently with deskt. It
                                        has survived not only five centuries, but
                                        also the leap into electronic typesetting,
                                        remaining essentially unchanged. It was
                                        popularised in the 1960s with the release of
                                        Letraset sheets containing Lorem Ipsum
                                        passages, and more recently with desktop
                                        publishing software like Aldus PageMaker
                                        including versions of Lorem Ipsum. t has
                                        survived not only five centuries, but also
                                        the leap into electronic typesetting,
                                        remaining essentially unchanged. It was
                                        popularised in the 1960s with the release of
                                        Letraset sheets containing Lorem Ipsum
                                        passages, and more recently with deskt.
                                    </p>
                                </a>
                            </section>
                        <footer>
                            <section class="reaction-container comment-container">
                                <button>
                                    <i class="ph ph-chats-circle icon comment-icon"></i>
                                    <span class="visually-hidden">Comentar post</span>
                                </button>
                                <p>20</p>
                            </section>
                            <section class="reaction-container like-container">
                                <button class="heart-button">
                                    <i class="ph ph-heart icon heart-icon"></i>
                                    <span class="visually-hidden">Dar favorito al post</span>
                                </button>
                                <p>1008</p>
                            </section>
                        </footer>
                    </article>
                <?php endif; ?> 
            </section>
        </section>
        <section class="most-recent-posts">
            <h2 class="section-title">Publicaciones más recientes</h2>
            <?php if (count($mostRelevantPosts) == 0): ?>
                    <p class="no-content-msg">No hay ningún post relacionado a este contenido</p>
                <?php else: ?> 
                    <article tabindex="0" class="post add-modal-access" id="post_1" aria-posinset="1" aria-setsize="3"
                    aria-labelledby="post-1-song-title post-1-artist-title" aria-describedby="post-content-1">
                    <figure>
                        <section class="article-img-container">
                            <img loading="lazy" class="image-border" width="100px" height="100px"
                                src="https://i.pinimg.com/564x/2f/18/9e/2f189e3be4ef04ab12a0a125efe4e67e.jpg"
                                alt="Portada del álbum 'Dark Side of The Moon' Pink Floyd" />
                        </section>
                        <section class="user-info">
                            <img loading="lazy" class="user-img" height="25px" width="25px"
                                src="https://i.pinimg.com/236x/94/7f/14/947f14841d26f5dc3541366a987b32f5.jpg"
                                alt="Imagen de perfil de 'Usuario 1'" />
                            <p class="user-name">
                                <a href="profile.html">Usuario 1</a>
                                <span>$username1</span>
                            </p>
                            <p class="post-time">hace 8 horas</p>
                        </section>
                        <figcaption>
                            <h3 class="song-title" id="post-1-song-title">
                                <a href="song.html">The Dark Side of the Moon</a>
                            </h3>
                            <h4 class="artist-title" id="post-1-artist-title">
                                Pink Floyd
                            </h4>
                            <span class="tag">Increible</span>
                            <span class="tag">Rock</span>
                            <span class="tag">Internacional</span>
                            <p class="stars">★★★★★</p>
                        </figcaption>
                    </figure>
                    <a href="post.html">
                        <section class="post-content" id="post-content-1">
                            <p>
                                It has survived not only five centuries, but
                                also the leap into electronic typesetting,
                                remaining essentially unchanged. It was
                                popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum
                                passages, and more recently with desktop
                                publishing software like Aldus PageMaker
                                including versions of Lorem Ipsum. t has
                                survived not only five centuries, but also
                                the leap into electronic typesetting,
                                remaining essentially unchanged. It was
                                popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum
                                passages, and more recently with deskt. It
                                has survived not only five centuries, but
                                also the leap into electronic typesetting,
                                remaining essentially unchanged. It was
                                popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum
                                passages, and more recently with desktop
                                publishing software like Aldus PageMaker
                                including versions of Lorem Ipsum. t has
                                survived not only five centuries, but also
                                the leap into electronic typesetting,
                                remaining essentially unchanged. It was
                                popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum
                                passages, and more recently with deskt.
                            </p>
                        </section>
                    </a>
                    <footer>
                        <section class="reaction-container comment-container">
                            <button>
                                <i class="ph ph-chats-circle icon comment-icon"></i>
                                <span class="visually-hidden">Comentar post</span>
                            </button>
                            <p>20</p>
                        </section>
                        <section class="reaction-container like-container">
                            <button class="heart-button">
                                <i class="ph ph-heart icon heart-icon"></i>
                                <span class="visually-hidden">Dar favorito al post</span>
                            </button>
                            <p>1008</p>
                        </section>
                    </footer>
                </article>
                <?php endif; ?> 
            </section>
        </section>
    </main>

    <footer class="main-footer">
        <?php require "fragments/footer.view.php"?>
    </footer>
</body>

</html>