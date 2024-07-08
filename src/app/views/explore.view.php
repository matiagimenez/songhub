<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "fragments/head.view.php"?>
</head>

<body>
    <header class="main-header" id="main-header">
        <?php require "fragments/header.view.php" ?>
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
        </header>
        <section id="search-results-section" style="display: none;">
            <section id="tacks-results" class="section" >
                <!-- Aquí se insertarán los resultados de la búsqueda -->
            </section>
            <section id="albums-results" class="section">
                <!-- Aquí se insertarán los resultados de la búsqueda -->
            </section>
        </section>
        <section class="section explore-section" id="recent-activity-section">
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
            <section class="section explore-section" id="recommendations-section">
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
        <section class="section explore-section" id="favorites-section">
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
        <section class="section explore-section" id="new-releases-section">
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