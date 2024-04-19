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
            <h2 class="section-title">Recomendaciones para vos</h2>

            <article class="add-modal-access">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy" width="200px" height="200px" src="https://i.pinimg.com/564x/89/28/e3/8928e372651fc60256360ba5e21a7d2f.jpg" alt="Portada del álbum 'Pulse' de Pink Floyd" class="image-border" />
                    </section>
                    <figcaption>
                        <a href="/content">
                            <h3 class="song-title">Pulse</h3>
                            <h4 class="artist-title">Pink Floyd</h4>
                        </a>
                    </figcaption>
                </figure>
            </article>

            <article class="add-modal-access">
                <figure>
                    <section class="article-img-container">
                        <img width="200px" height="200px" loading="lazy" src="https://i.pinimg.com/564x/99/41/82/99418264794012ddd044c761919fbb44.jpg" alt="Portada del álbum 'Punisher' de Phoebe Bridgers" class="image-border" />
                    </section>
                    <figcaption>
                        <a href="/content">
                            <h3 class="song-title">Punisher</h3>
                            <h4 class="artist-title">Phoebe Bridgers</h4>
                        </a>
                    </figcaption>
                </figure>
            </article>

            <article class="add-modal-access">
                <figure>
                    <section class="article-img-container">
                        <img width="200px" height="200px" loading="lazy" src="https://i.pinimg.com/564x/94/76/b8/9476b8e8cb9368ceba6f90bec0c1b980.jpg" alt="Portada del álbum 'Random Acces Memories' de Daft Punk" class="image-border" />
                    </section>
                    <figcaption>
                        <a href="/content">
                            <h3 class="song-title">
                                Random Acces Memories
                            </h3>
                            <h4 class="artist-title">Daft Punk</h4>
                        </a>
                    </figcaption>
                </figure>
            </article>

            <article class="add-modal-access">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy" width="200px" height="200px" src="https://i.pinimg.com/564x/dd/ff/e0/ddffe0a469a486bdde609fe2467e75c1.jpg" alt="Portada del álbum 'Led Zeppelin III' de Led Zeppelin" class="image-border" />
                    </section>
                    <figcaption>
                        <a href="/content">
                            <h3 class="song-title">Led Zeppelin III</h3>
                            <h4 class="artist-title">Led Zeppelin</h4>
                        </a>
                    </figcaption>
                </figure>
            </article>

            <article class="add-modal-access">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy" width="200px" height="200px" src="https://i.pinimg.com/564x/54/4b/29/544b2906bb15ffaa689bf096b3d850e4.jpg" alt="Portada del álbum 'Happier Than Ever' de Billie Eilish" class="image-border" />
                    </section>
                    <figcaption>
                        <a href="/content">
                            <h3 class="song-title">Happier Than Ever</h3>
                            <h4 class="artist-title">Billie Eilish</h4>
                        </a>
                    </figcaption>
                </figure>
            </article>

            <article class="add-modal-access">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy" width="200px" height="200px" src="https://i.pinimg.com/564x/50/75/92/5075926b9579b1155b7e4366184c0f64.jpg" alt="Portada del álbum 'X100PRE' de Bad Bunny" class="image-border" />
                    </section>
                    <figcaption>
                        <a href="/content">
                            <h3 class="song-title">X100PRE</h3>
                            <h4 class="artist-title">Bad Bunny</h4>
                        </a>
                    </figcaption>
                </figure>
            </article>
        </section>


    </main>

    <footer class="main-footer">
        <?php require "fragments/footer.view.php" ?>
    </footer>
</body>

</html>