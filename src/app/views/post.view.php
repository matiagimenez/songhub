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
    <link rel="stylesheet" href="../styles/post.css" />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="../scripts/index.js" type="module"></script>
    <title>Post | SongHub</title>
</head>

<body>
    <header class="main-header" id="main-header">
        <?php require "fragments/header.view.php"?>
    </header>

    <main>
        <article class="post add-modal-access main-post" id="post_1">
            <figure>
                <section class="article-img-container">
                    <img loading="lazy" class="image-border" height="100px" width="100px"
                        src="https://i.pinimg.com/564x/2f/18/9e/2f189e3be4ef04ab12a0a125efe4e67e.jpg"
                        alt="Portada del álbum 'The Dark Side of the Moon' de Pink Floyd" />
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
                    <h2 class="song-title" id="post-1-song-title">
                        <a href="/content">The Dark Side of the Moon</a>
                    </h2>
                    <h3 class="artist-title">Pink Floyd</h3>
                    <span class="tag">Increible</span>
                    <span class="tag">Rock</span>
                    <span class="tag">Internacional</span>
                    <p class="stars">★★★★★</p>
                </figcaption>
            </figure>
            <section class="post-content">
                <p>
                    It has survived not only five centuries, but also the
                    leap into electronic typesetting, remaining essentially
                    unchanged. It was popularised in the 1960s with the
                    release of Letraset sheets containing Lorem Ipsum
                    passages, and more recently with desktop publishing
                    software like Aldus PageMaker including versions of
                    Lorem Ipsum. t has survived not only five centuries, but
                    also the leap into electronic typesetting, remaining
                    essentially unchanged. It was popularised in the 1960s
                    with the release of Letraset sheets containing Lorem
                    Ipsum passages, and more recently with deskt. It has
                    survived not only five centuries, but also the leap into
                    electronic typesetting, remaining essentially unchanged.
                    It was popularised in the 1960s with the release of
                    Letraset sheets containing Lorem Ipsum passages, and
                    more recently with desktop publishing software like
                    Aldus PageMaker including versions of Lorem Ipsum. t has
                    survived not only five centuries, but also the leap into
                    electronic typesetting, remaining essentially unchanged.
                    It was popularised in the 1960s with the release of
                    Letraset sheets containing Lorem Ipsum passages, and
                    more recently with deskt.
                </p>
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

        <section id="comment-form-container">
            <section class="user-info">
                <img loading="lazy" class="user-img" height="25px" width="25px"
                src="https://i.pinimg.com/236x/94/7f/14/947f14841d26f5dc3541366a987b32f5.jpg"
                alt="Imagen de perfil de 'Usuario 1'" />
            </section>
            <form action="/comment" method="POST">
                <p>Responde a <a href="/profile">@username</a><p>
                <div>
                    <textarea class='input'required placeholder="Agrega un comentario..."></textarea>
                    <input type="submit" class="submit-button" value="Comentar" />
                </div>
            </form>
        </section>
        
        <section class="comments">
            <article class="post" id="post_1_1">
                <header class="user-info">
                    <img loading="lazy" class="user-img"
                        src="https://i.pinimg.com/236x/2d/92/d0/2d92d085613a400e12fbadacc019e0e2.jpg"
                        alt="Imagen de perfil de 'Usuario 2'" height="50px" width="50px" />
                    <p class="user-name">
                        <a href="profile.html">Usuario 2</a>
                        <span>@username2</span>
                        <span class="post-time">hace 8 horas</span>
                    </p>
                </header>
                <section class="post-content">
                    <p>
                        It has survived not only five centuries, but also
                        the leap into electronic typesetting, remaining
                        essentially unchanged. It was popularised in the
                        1960s with the release of Letraset sheets containing
                        Lorem Ipsum passages, and more recently with desktop
                        publishing software like Aldus PageMaker including
                        versions of Lorem Ipsum.
                    </p>
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

            <article class="post" id="post_1_2">
                <header class="user-info">
                    <img loading="lazy" class="user-img"
                        src="https://i.pinimg.com/564x/d4/36/ba/d436bae8fa33079d14e74b2213c0183a.jpg"
                        alt="Imagen de perfil de 'Usuario 3'" height="50px" width="50px" />
                    <p class="user-name">
                        <a href="profile.html">Usuario 3</a>
                        <span>@username3</span>
                        <span class="post-time">hace 4h</span>
                    </p>
                </header>
                <section class="post-content">
                    <p>
                        It has survived not only five centuries, but also
                        the leap into electronic typesetting, remaining
                        essentially unchanged. It was popularised in the
                        1960s with the release of Letraset sheets containing
                        Lorem Ipsum passages, and more recently with desktop
                        publishing software like Aldus PageMaker including
                        versions of Lorem Ipsum.
                    </p>
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

            <article class="post" id="post_1_3">
                <header class="user-info">
                    <img loading="lazy" class="user-img"
                        src="https://i.pinimg.com/564x/d4/36/ba/d436bae8fa33079d14e74b2213c0183a.jpg"
                        alt="Imagen de perfil de 'Usuario 3'" height="50px" width="50px" />
                    <p class="user-name">
                        <a href="profile.html">Usuario 3</a>
                        <span>@username3</span>
                        <span class="post-time">hace 4h</span>
                    </p>
                </header>
                <section class="post-content">
                    <p>
                        It has survived not only five centuries, but also
                        the leap into electronic typesetting, remaining
                        essentially unchanged. It was popularised in the
                        1960s with the release of Letraset sheets containing
                        Lorem Ipsum passages, and more recently with desktop
                        publishing software like Aldus PageMaker including
                        versions of Lorem Ipsum.
                    </p>
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
        </section>
    </main>
    <footer class="main-footer">
        <?php require "fragments/footer.view.php"?>
    </footer>
</body>

</html>