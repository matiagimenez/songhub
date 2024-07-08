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
    <meta property="og:image" content="https://images.unsplash.com/photo-1485579149621-3123dd979885?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fG11c2ljfGVufDB8fDB8fHww" />
    <meta property="og:url" content="" id="og-url" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" type="image/x-icon" href="/assets/icons/favicon.svg" />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="../styles/explore.css" />
    <script src="../scripts/index.js" type="module"></script>
    <title>Explorar | SongHub</title>
</head>

<body>
    <header class="main-header" id="main-header">
        <?php require "fragments/header.view.php" ?>
    </header>
    <main>
        <section class="section">
            <h2 class="section-title">Tu actividad reciente en Spotify</h2>
            <?php foreach($recentActivity as $item): ?>
                <article class="add-modal-access" id=<?= $item["track_id"] ?> data-type=<?= $item["type"] ?> data-username=<?= $username?> >
                    <figure>
                        <section class="article-img-container">
                            <img loading="lazy" width="180px" height="180px" src=<?= $item["images"][0]["url"]?> alt="<?= 'Portada del ' . $item["type"] . " " . $item["track_name"] . ' del artista ' . $item["artist_name"] ?>" class="image-border" />
                        </section>
                        <figcaption>
                            <a href=<?= "/content?id=". $item["track_id"] . "&type=" . $item["type"] ?> >
                                <h3 class="song-title"><?= $item["track_name"] ?></h3>
                                <h4 class="artist-title"><?= $item["artist_name"] ?></h4>
                            </a>
                        </figcaption>
                    </figure>
                </article>
            <?php endforeach; ?>            
        </section>
        <?php if(count($recommendations) > 0): ?>
            <section class="section">
                <h2 class="section-title">Nuestras recomendaciones</h2>
                <?php foreach($recommendations as $item): ?>
                    <article class="add-modal-access" id=<?= $item["track_id"] ?> data-type=<?= $item["type"]?> data-username=<?= $username?>  >
                        <figure>
                            <section class="article-img-container">
                                <img loading="lazy" width="180px" height="180px" src=<?= $item["images"][0]["url"]?> alt="<?= 'Portada del ' . $item["type"] . " " . $item["track_name"]. $item["track_name"] . ' del artista ' . $item["artist_name"] ?>"  class="image-border" />
                            </section>
                            <figcaption>
                                <a href=<?= "/content?id=". $item["track_id"] . "&type=" . $item["type"] ?> >
                                    <h3 class="song-title"><?= $item["track_name"] ?></h3>
                                    <h4 class="artist-title"><?= $item["artist_name"] ?></h4>
                                </a>
                            </figcaption>
                        </figure>
                    </article>
                <?php endforeach; ?>   
            </section>
        <?php endif; ?>
        <section class="section">
            <h2 class="section-title">Tu contenido favorito</h2>
            <?php foreach($userTopTracks as $item): ?>
                <article class="add-modal-access" id=<?= $item["track_id"] ?> data-type=<?= $item["type"] ?> data-username=<?= $username?>  >
                    <figure>
                        <section class="article-img-container">
                            <img loading="lazy" width="180px" height="180px" src=<?= $item["images"][0]["url"]?> alt="<?= 'Portada del '  . $item["type"] . " " . $item["track_name"] . ' del artista ' . $item["artist_name"] ?>"  class="image-border" />
                        </section>
                        <figcaption>
                            <a href=<?= "/content?id=". $item["track_id"] . "&type=" . $item["type"] ?> >
                                <h3 class="song-title"><?= $item["track_name"] ?></h3>
                                <h4 class="artist-title"><?= $item["artist_name"] ?></h4>
                            </a>
                        </figcaption>
                    </figure>
                </article>
            <?php endforeach; ?>   
        </section>
        <section class="section">
            <h2 class="section-title">Nuevos lanzamientos</h2>
            <?php foreach($newReleases as $item): ?>
                <article class="add-modal-access" id=<?= $item["album_id"] ?> data-type=<?= $item["type"] ?> data-username=<?= $username?> >
                    <figure>
                        <section class="article-img-container">
                            <img loading="lazy" width="180px" height="180px" src=<?= $item["images"][0]["url"]?> alt="<?= 'Portada del '  . $item["type"] . " " . $item["album_name"]. ' del artista ' . $item["artist_name"] ?>"  class="image-border" />
                        </section>
                        <figcaption>
                            <a href=<?= "/content?id=". $item["album_id"] . "&type=" . $item["type"] ?> >
                                <h3 class="song-title"><?= $item["album_name"] ?></h3>
                                <h4 class="artist-title"><?= $item["artist_name"] ?></h4>
                            </a>
                        </figcaption>
                    </figure>
                </article>
            <?php endforeach; ?>   
        </section>
    </main>

    <footer class="main-footer">
        <?php require "fragments/footer.view.php" ?>
    </footer>
</body>

</html>