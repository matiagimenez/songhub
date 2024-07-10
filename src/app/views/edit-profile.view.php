<!DOCTYPE html>
<html lang="es">

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
    <link rel="stylesheet" href="../styles/edit-profile.css" />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="../scripts/index.js" type="module"></script>
    <title>Editar perfil | SongHub</title>
</head>

<body>
    <header class="main-header" id="main-header">
        <?php require "fragments/header.view.php"?>
    </header>
    <?php 
            // echo "<pre>";
            // var_dump($user);
            // var_dump($userNationality);
            // var_dump($favorites);
            // die;    
    ?>
    <main>
        <h2 class="section-title">Información del perfil</h2>
        <form action="/user/profile" method="POST">
            <fieldset>
                <legend>Información de perfil</legend>
                <p class="profile-image-edit">
                    <img src=<?= $user->fields["SPOTIFY_AVATAR"] ?>
                        alt="<?= "Avatar del usuario " . $user->fields["USERNAME"] ?>" height="150px" width="150px" class="image-border" />
                </p>
                <p class="input-container name-edit">
                    <label for="firstname" class="label">Nombre</label>
                    <input class="input" name="name" id="name" type="text" value="<?= $user->fields["NAME"]?>" maxlength="60"/>
                </p>
                <p class="input-container username-edit">
                    <label for="username" class="label">Nombre de usuario</label>
                    <input class="input" name="username" id="username" type="text" disabled value="<?= $user->fields["USERNAME"]?>"/>
                    <input class="input" name="username" id="username-hidden" type="hidden" value="<?= $user->fields["USERNAME"]?>"/>
                </p>
                <p class="input-container email-edit">
                    <label for="email" class="label">Correo electrónico</label>
                    <input class="input" name="email" id="email" type="email" disabled value="<?= $user->fields["EMAIL"]?>"/>
                </p>
                <p class="input-container country-edit">
                    <label for="country" class="label">Pais</label>
                    <select class="input" name="country" id="country">
                        <?php if($userNationality == null):?>
                            <option value="0" selected> - - -</option>
                        <?php else: ?>
                            <option value="0"> - - -</option>
                        <?php endif; ?> 
                         
                        <?php foreach ($countries as $country): ?>                     
                            <?php if($userNationality && $user->fields["COUNTRY_ID"] == $country->fields["COUNTRY_ID"]):?>
                                <option value=<?= $country->fields["COUNTRY_ID"]?> selected><?= $country->fields["NAME"] ?></option>
                            <?php else: ?>
                                <option value=<?= $country->fields["COUNTRY_ID"] ?> > <?= $country->fields["NAME"] ?> </option>
                            <?php endif; ?>
                        <?php endforeach;?>
                    </select>
                </p>
                <p class="input-container biography-edit">
                    <label for="biography" class="label">Biografía</label>
                    <textarea name="biography" id="biography" class="input" maxlength="160"><?= $user->fields["BIOGRAPHY"]?></textarea>
                </p>
                <?php if (strlen($message) > 0): ?>
                    <p class="error-message"><?=$message?></p>
                <?php endif;?>
                <p class="button-container">
                    <a class="submit-outline-button" href="<?= "/user?username=" . $user->fields["USERNAME"] ?>">Volver</a>
                    <input class="submit-button" type="submit" value="Guardar cambios" />
                </p>
            </fieldset>
        </form>
        <section class="edit-favourites">
            <h3 class="section-title">Álbumes Favoritos</h3>
            <ul class="edit-favourites-list">
            <?php if(count($favorites["FAVORITE_ALBUMS"]) == 0): ?>
                <p class="no-content-msg">No marcaste ningun álbum como favorito </p>
            <?php else: ?>
                <?php foreach($favorites["FAVORITE_ALBUMS"] as $album): ?>
                    <li class="edit-favourite-item">
                        <figure aria-describedby="favourite-song-1">
                            <img loading="lazy" src=<?= $album->fields["COVER_ID"] ?>
                                alt="Portada del álbum <?= $album->fields["TITLE"] ?> de <?= $album -> fields["ARTIST_NAME"] ?>"
                                width="120px" 
                                height="120px"
                                class="image-border" />
                            <figcaption>
                                <h4><?= $album->fields["TITLE"] ?></h4>
                                <h5><?= $album -> fields["ARTIST_NAME"] ?></h5>
                            </figcaption>
                            <button class="remove-favorite" data-content=<?= $album->fields["CONTENT_ID"]?> >
                                <i class="ph ph-trash-simple icon remove-favorite-icon"></i>
                                <span class="visually-hidden">Remover de favoritos</span>
                            </button>
                        </figure>
                    </li>
                <?php endforeach; ?>   
            <?php endif; ?>
                <li class="edit-favourite-item">
                    <a href="/explore" class="add-favorite">
                        <span>Agregar álbum a favoritos</span>
                        <i class="ph ph-music-notes-plus icon add-favorite-icon"></i>
                    </a>       
                </li>
            </ul>
        </section>

        <section class="edit-favourites">
            <h3 class="section-title">Canciones Favoritas</h3>
            <ul class="edit-favourites-list">
            <?php if(count($favorites["FAVORITE_TRACKS"]) == 0): ?>
                <p class="no-content-msg">No marcaste ninguna canción como favorita </p>
            <?php else: ?>
                <?php foreach($favorites["FAVORITE_TRACKS"] as $track): ?>
                    <li class="edit-favourite-item">
                        <figure aria-describedby="favourite-song-4">
                            <img loading="lazy" src=<?= $track->fields["COVER_ID"] ?>
                                alt="Portada de la canción <?= $track->fields["TITLE"] ?> de <?= $track -> fields["ARTIST_NAME"] ?>"
                                width="120px" 
                                height="120px"
                                class="image-border" />
                            <figcaption>
                                <h4><?= $track->fields["TITLE"] ?></h4>
                                <h5><?= $track -> fields["ARTIST_NAME"] ?></h5>
                            </figcaption>
                            <button class="remove-favorite" data-content=<?= $track->fields["CONTENT_ID"]?> >
                                <i class="ph ph-trash-simple icon remove-favorite-icon"></i>
                                <span class="visually-hidden">Remover de favoritos</span>
                            </button>
                        </figure>
                    </li>
                <?php endforeach; ?>   
            <?php endif; ?>
                <li class="edit-favourite-item">
                    <a href="/explore" class="add-favorite">
                        <span>Agregar canción a favoritos</span>
                        <i class="ph ph-music-notes-plus icon add-favorite-icon"></i>
                    </a>       
                </li>
            </ul>
        </section>
    </main>
</body>

</html>