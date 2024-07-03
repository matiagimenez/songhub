<?php
use Songhub\core\Session;

$isAuthenticated = Session::getInstance()->exists("username");

if ($isAuthenticated) {
    $username = Session::getInstance()->get("username");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "fragments/head.view.php"?>
</head>


<body>
    <header class="main-header" id="main-header">
        <?php require "fragments/header.view.php"?>
    </header>
    <main>
        <?php 
            // echo "<pre>";
            // var_dump($country);
            // var_dump($user);
            // die;
        ?>
        <header>
            <section class="user">
                <img src=<?=$user->fields["SPOTIFY_AVATAR"]?> alt="<?= "Avatar del usuario " . $user->fields["USERNAME"] ?>" height="60px" width="60px"
                    class="image-border" />
                <p class="username-container">
                    <span class="name"><?=$user->fields["NAME"]?></span>
                    <span class="username">$<?=$user->fields["USERNAME"]?></span>
                </p>
            </section>

            <section class="user-stats">
                <ul>
                    <li><span><?=count($posts)?></span>POSTS</li>
                    <li><span><?=$followers?></span>SEGUIDORES</li>
                    <li><span><?=$following?></span>SEGUIDOS</li>
                </ul>
            </section>

            <section class="user-actions">
                <p class="profile-button-container">
                    <?php if ($username === $user->fields["USERNAME"]): ?>
                    <a href="/user/profile" class="submit-outline-button">
                        Editar perfil
                    </a>
                    <?php else: ?>
                    <button class="action-button submit-outline-button">
                        Siguiendo
                    </button>
                    <?php endif?>

                    <a class="submit-button spotify-profile-button" href=<?=$user->fields["SPOTIFY_URL"]?> target="_blank">
                        <img src="/assets/icons/spotify.svg" alt="Logo de Spotify" />
                        <span> Perfil </span>
                    </a>
                </p>
            </section>
            <section>
                <?php if ($user->fields["COUNTRY_ID"]): ?>
                    <p class="nationality">
                        <?=$country->fields["NAME"]?>
                    </p>
                <?php endif; ?>
                <p class="biography">
                    <?=$user->fields["BIOGRAPHY"]?>
                </p>
            </section>
        </header>

        <section class="section">
            <h2 class="section-title">Tus álbumes favoritos</h2>
            <article class="add-modal-access" aria-describedby="favourite-song-1">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy"
                            src="https://i.pinimg.com/564x/89/28/e3/8928e372651fc60256360ba5e21a7d2f.jpg"
                            alt="Portada del álbum 'Pulse' de Pink Floyd" width="150px" height="150px"
                            class="image-border" />
                    </section>
                    <figcaption id="favourite-song-1">
                        <h3 class="song-title">Pulse</h3>
                        <h4 class="artist-title">Pink Floyd</h4>
                    </figcaption>
                </figure>
            </article>

            <article class="add-modal-access" aria-describedby="favourite-song-2">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy"
                            src="https://i.pinimg.com/564x/99/41/82/99418264794012ddd044c761919fbb44.jpg"
                            alt="Portada del álbum 'Punisher' de Phoebe Bridgers" width="150px" height="150px"
                            class="image-border" />
                    </section>
                    <figcaption id="favourite-song-2">
                        <h3 class="song-title">Punisher</h3>
                        <h4 class="artist-title">Phoebe Bridgers</h4>
                    </figcaption>
                </figure>
            </article>

            <article class="add-modal-access" aria-describedby="favourite-song-3">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy"
                            src="https://i.pinimg.com/564x/94/76/b8/9476b8e8cb9368ceba6f90bec0c1b980.jpg"
                            alt="Portada del álbum 'Random Acces Memories' de Daft Punk" width="150px" height="150px"
                            class="image-border" />
                    </section>
                    <figcaption id="favourite-song-3">
                        <h3 class="song-title">Random Acces Memories</h3>
                        <h4 class="artist-title">Daft Punk</h4>
                    </figcaption>
                </figure>
            </article>
        </section>

        <section class="section">
            <h2 class="section-title">Tus canciones favoritas</h2>

            <article class="add-modal-access" aria-describedby="favourite-song-4">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy"
                            src="https://i.pinimg.com/564x/3d/65/d5/3d65d5e4af0cde2458b2e7b55869f4e6.jpg"
                            alt="Portada del álbum 'Peso Pluma || Music Session' de Bizarrap" width="150px"
                            height="150px" class="image-border" />
                    </section>
                    <figcaption id="favourite-song-4">
                        <h3 class="song-title">
                            Peso Pluma || Music Session
                        </h3>
                        <h4 class="artist-title">Bizarrap</h4>
                    </figcaption>
                </figure>
            </article>

            <article class="add-modal-access" aria-describedby="favourite-song-5">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy"
                            src="https://i.pinimg.com/564x/aa/af/30/aaaf30cb2a66f80057d06d8e78b0bd3e.jpg"
                            alt="Portada del álbum 'Bad Habit' de Steve Lazy" width="150px" height="150px"
                            class="image-border" />
                    </section>
                    <figcaption id="favourite-song-5">
                        <h3 class="song-title">Bad Habit</h3>
                        <h4 class="artist-title">Steve Lazy</h4>
                    </figcaption>
                </figure>
            </article>

            <article class="add-modal-access" aria-describedby="favourite-song-6">
                <figure>
                    <section class="article-img-container">
                        <img loading="lazy"
                            src="https://i.pinimg.com/564x/28/83/60/288360836d7d5532e52012bf06981410.jpg"
                            alt="Portada del álbum 'Comfortably Numb' de Pink Floyd" width="150px" height="150px"
                            class="image-border" />
                    </section>
                    <figcaption id="favourite-song-6">
                        <h3 class="song-title">Comfortably Numb</h3>
                        <h4 class="artist-title">Pink Floyd</h4>
                    </figcaption>
                </figure>
            </article>
        </section>
        <section class="recent-activity">
            <h2 class="section-title">Actividad reciente</h2>
            <?php if(count($posts) == 0): ?>
                <p class="no-content-msg">El usuario <?= $user->fields["USERNAME"]?> no ha realizado ningún post</p>
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
                                <a href="/content">The Dark Side of the Moon</a>
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
            <?php endif; ?>
        </section>
    </main>
</body>

</html>