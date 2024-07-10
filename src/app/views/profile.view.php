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
            // var_dump($favorites);
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
                <?php if (strlen($message) > 0): ?>
                    <p class="info-message"><?=$message?></p>
                <?php endif;?>
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
            <?php if(count($favorites["FAVORITE_ALBUMS"]) == 0): ?>
                <?php if ($username === $user->fields["USERNAME"]): ?>
                    <p class="no-content-msg">No marcaste ningun álbum como favorito </p>
                <?php else: ?>
                    <p class="no-content-msg">El usuario <?= $username?> no tiene álbumes favoritos </p>
                <?php endif?>
            <?php else: ?>
                <?php foreach($favorites["FAVORITE_ALBUMS"] as $index => $album): ?>
                    <article class="add-modal-access" aria-describedby="<?= "Album favorito " . $index ?>">
                        <figure>
                            <section class="article-img-container">
                                <img loading="lazy"
                                    src=<?= $album->fields["COVER_ID"] ?>
                                    alt="Portada del álbum <?= $album->fields["TITLE"] ?> de <?= $album -> fields["ARTIST_NAME"] ?>" 
                                    width="150px" 
                                    height="150px"
                                    class="image-border" />
                            </section>
                            <figcaption id="<?= "Album favorito " . $index ?>">
                                <a href="/content?id=<?=$album->fields["CONTENT_ID"]?>&type=album">
                                    <h3 class="song-title"><?= $album->fields["TITLE"] ?></h3>
                                    <h4 class="artist-title"><?= $album->fields["ARTIST_NAME"] ?></h4>
                                </a>   
                            </figcaption>
                        </figure>
                    </article>
                <?php endforeach; ?>   
            <?php endif; ?>
        </section>

        <section class="section">
            <h2 class="section-title">Tus canciones favoritas</h2>
            <?php if(count($favorites["FAVORITE_TRACKS"]) == 0): ?>
                <?php if ($username === $user->fields["USERNAME"]): ?>
                    <p class="no-content-msg">No marcaste ninguna canción como favorita </p>
                <?php else: ?>
                    <p class="no-content-msg">El usuario <?= $username?> no tiene canciones favoritas </p>
                <?php endif?>
            <?php else: ?>
                <?php foreach($favorites["FAVORITE_TRACKS"] as $index => $track): ?>
                    <article class="add-modal-access" aria-describedby="<?= "Canción favorita " . $index ?>">
                        <figure>
                            <section>
                                <img loading="lazy"
                                src=<?= $track->fields["COVER_ID"] ?>
                                alt="Portada de la canción <?= $track->fields["TITLE"] ?> de <?= $track -> fields["ARTIST_NAME"] ?>"
                                width="150px"
                                height="150px" 
                                class="image-border" />
                        </section>
                            <figcaption id="<?= "Canción favorita " . $index ?>">
                                <a href="/content?id=<?=$track->fields["CONTENT_ID"]?>&type=track ">
                                    <h3 class="song-title"><?= $track->fields["TITLE"] ?></h3>
                                    <h4 class="artist-title"><?= $track->fields["ARTIST_NAME"] ?></h4>
                                </a>
                            </figcaption>
                        </figure>
                    </article>
                <?php endforeach; ?>   
            <?php endif; ?>
        </section>
        <section class="recent-activity">
            <h2 class="section-title">Actividad reciente</h2>
            <?php if(count($posts) == 0): ?>
                <?php if ($username === $user->fields["USERNAME"]): ?>
                    <p class="no-content-msg"> Aún no realizaste ningún post </p>
                <?php else: ?>
                    <p class="no-content-msg">El usuario <?= $user->fields["USERNAME"]?> no ha realizado ningún post</p>
                <?php endif?>
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