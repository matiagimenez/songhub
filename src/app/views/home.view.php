<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "fragments/head.view.php"?>
</head>

<body>

    <body id="home">
        <header class="main-header" id="main-header">
            <?php require "fragments/header.view.php"?>
        </header>
        <main>
            <ul class="cards-container" aria-roledescription="carousel" aria-label="Carrusel de discos de música">
                <li role="listitem" aria-roledescription="slide" aria-labelledby="album-1-title">
                    <figure class="active" data-item-index="0">
                        <img src="/assets/images/home/carousel/carousel_image_1.jpg"
                            alt="Portada del álbum 'Starboy' de The Weeknd" width="250" height="300" />
                        <figcaption id="album-1-title">
                            <a href="song.html" target="_blank">
                                <h2>Starboy</h2>
                                <h3>The Weeknd</h3>
                            </a>
                        </figcaption>
                    </figure>
                </li>
                <li role="listitem" aria-labelledby="album-2-title" aria-roledescription="slide">
                    <figure data-item-index="1">
                        <img src="/assets/images/home/carousel/carousel_image_2.jpg"
                            alt="Portada del álbum 'Justice' de Justin Bieber" width="250" height="300" />
                        <figcaption id="album-2-title">
                            <a href="song.html" target="_blank">
                                <h2>Justice</h2>
                                <h3>Justin Bieber</h3>
                            </a>
                        </figcaption>
                    </figure>
                </li>
                <li role="listitem" aria-labelledby="album-3-title" aria-roledescription="slide">
                    <figure data-item-index="2">
                        <img src="/assets/images/home/carousel/carousel_image_3.jpg"
                            alt="Portada del álbum 'DAMN.' de Kendrick Lamar" width="250" height="300" />
                        <figcaption id="album-3-title">
                            <a href="song.html" target="_blank">
                                <h2>DAMN.</h2>
                                <h3>Kendrick Lamar</h3>
                            </a>
                        </figcaption>
                    </figure>
                </li>
                <li role="listitem" aria-labelledby="album-4-title" aria-roledescription="slide">
                    <figure data-item-index="3">
                        <img src="/assets/images/home/carousel/carousel_image_4.jpg"
                            alt="Portada del álbum 'SOS' de SZA" width="250" height="300" />
                        <figcaption id="album-4-title">
                            <a href="song.html" target="_blank">
                                <h2>SOS</h2>
                                <h3>SZA</h3>
                            </a>
                        </figcaption>
                    </figure>
                </li>
            </ul>
            <!-- se debe cambiar aria-busy="true" cuando se esté cargando/actualizando el feed -->

            <section class="feed" role="feed" aria-labelledby="feed-title" aria-busy="false">
                <a href="/search" id="create-post" class="create-post submit-button"><span>Crear un post</span></a>

                <h2 class="section-title" id="feed-title">Últimos posts</h2>
                <!-- se debe actualizar aria-setsize="n" siendo n la cantidad de post cargados en el feed.
				Algo como ir llevando una variable acumuladora con la cantidad de post que se van cargando
				y actualizar el valor de aria-setsize con el valor de esa variable acumuladora.
			-->
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
                                Letraset sheets containing Lorem Ipsum passages,
                                and more recently with desktop publishing
                                software like Aldus PageMaker including versions
                                of Lorem Ipsum. t has survived not only five
                                centuries, but also the leap into electronic
                                typesetting, remaining essentially unchanged. It
                                was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages,
                                and more recently with deskt. It has survived
                                not only five centuries, but also the leap into
                                electronic typesetting, remaining essentially
                                unchanged. It was popularised in the 1960s with
                                the release of Letraset sheets containing Lorem
                                Ipsum passages, and more recently with desktop
                                publishing software like Aldus PageMaker
                                including versions of Lorem Ipsum. t has
                                survived not only five centuries, but also the
                                leap into electronic typesetting, remaining
                                essentially unchanged. It was popularised in the
                                1960s with the release of Letraset sheets
                                containing Lorem Ipsum passages, and more
                                recently with deskt.
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
                <article tabindex="0" class="post add-modal-access" id="post_2" aria-posinset="2" aria-setsize="3"
                    aria-labelledby="post-2-song-title post-2-artist-title" aria-describedby="post-content-2">
                    <figure>
                        <section class="article-img-container">
                            <img loading="lazy" height="100px" width="100px" class="image-border"
                                src="https://i.pinimg.com/236x/73/01/9f/73019f71f5bc1124787d11044d21d12d.jpg"
                                alt="Portada del álbum 'Preacher`s Daughter' de Ethel Cain" />
                        </section>
                        <section class="user-info">
                            <img loading="lazy" class="user-img" height="25px" width="25px"
                                src="https://i.pinimg.com/236x/2d/92/d0/2d92d085613a400e12fbadacc019e0e2.jpg"
                                alt="Imagen de perfil de 'Usuario 2'" />
                            <p class="user-name">
                                <a href="profile.html">Usuario 2</a>
                                <span>$username2</span>
                            </p>
                            <p class="post-time">hace 8 horas</p>
                        </section>
                        <figcaption>
                            <h3 class="song-title" id="post-2-song-title">
                                <a href="song.html"> Preacher`s Daughter </a>
                            </h3>
                            <h4 class="artist-title" id="post-2-artist-title">
                                Ethel Cain
                            </h4>
                            <span class="tag">Chill</span>
                            <span class="tag">Internacional</span>
                            <p class="stars">★★★★½</p>
                        </figcaption>
                    </figure>
                    <a href="post.html">
                        <section class="post-content" id="post-content-2">
                            <p>
                                It has survived not only five centuries, but
                                also the leap into electronic typesetting,
                                remaining essentially unchanged. It was
                                popularised in the 1960s.
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
                <article class="post add-modal-access" id="post_3" tabindex="0" aria-posinset="3" aria-setsize="3"
                    aria-labelledby="post-3-song-title post-3-artist-title" aria-describedby="post-content-3">
                    <figure>
                        <section class="article-img-container">
                            <img loading="lazy" class="image-border" height="100px" width="100px"
                                src="https://i.pinimg.com/236x/bf/00/49/bf0049614afb7ec4f5f64bb20834d728.jpg"
                                alt="Portada del álbum 'Certified Lover Boy' de Drake" />
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
                            <h3 class="song-title" id="post-3-song-title">
                                <a href="song.html"> Certified Lover Boy </a>
                            </h3>
                            <h4 class="artist-title" id="post-3-artist-title">
                                Drake
                            </h4>
                            <span class="tag">Amazing</span>
                            <span class="tag">Trap</span>
                            <span class="tag">Drake</span>
                            <p class="stars">★★★½</p>
                        </figcaption>
                    </figure>
                    <a href="post.html">
                        <section class="post-content" id="post-content-3">
                            <p>
                                It has survived not only five centuries, but
                                also the leap into electronic typesetting,
                                remaining essentially unchanged. It was
                                popularised in the 1960s.
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
            </section>
        </main>
    </body>
</body>

</html>