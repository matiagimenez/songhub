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
            // var_dump($countries);
            // die;    
    ?>
    <main>
        <h2 class="section-title">Información del perfil</h2>
        <form action="/" method="POST">
            <fieldset>
                <legend>Información de perfil</legend>
                <p class="profile-image-edit">
                    <img src=<?= $user->fields["SPOTIFY_AVATAR"] ?>
                        alt="<?= "Avatar del usuario " . $user->fields["USERNAME"] ?>" height="150px" width="150px" class="image-border" />
                </p>
                <p class="input-container name-edit">
                    <label for="firstname" class="label">Nombre</label>
                    <input class="input" name="firstname" id="firstname" type="text" value="<?= $user->fields["NAME"]?>" maxlength="60"/>
                </p>
                <p class="input-container username-edit">
                    <label for="username" class="label">Nombre de usuario</label>
                    <input class="input" name="username" id="username" type="text" disabled value="<?= $user->fields["USERNAME"]?>"/>
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
                            <?php if($userNationality && $userNationality->fields["COUNTRY_ID"] == $country->fields["COUNTRY_ID"]):?>
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
                <p class="button-container">
                    <a class="submit-outline-button" href="<?= "/user?username=" . $user->fields["USERNAME"] ?>">Volver</a>
                    <input class="submit-button" type="submit" value="Guardar cambios" />
                </p>
            </fieldset>
        </form>
        <section class="edit-favourites">
            <h3 class="section-title">Álbumes Favoritos</h3>
            <ul class="edit-favourites-list">
                <li class="edit-favourite-item">
                    <figure aria-describedby="favourite-song-1">
                        <img loading="lazy" src="https://i.pinimg.com/564x/89/28/e3/8928e372651fc60256360ba5e21a7d2f.jpg"
                            alt="Portada del álbum 'Pulse' de Pink Floyd" width="120px" height="120px"
                            class="image-border" />
                        <figcaption>
                            <h4>Pulse</h4>
                            <h5>Pink Floyd</h5>
                        </figcaption>
                        <button class="remove-favorite">
                            <i class="ph ph-trash-simple icon remove-favorite-icon"></i>
                            <span class="visually-hidden">Remover de favoritos</span>
                        </button>
                    </figure>
                </li>
                <li class="edit-favourite-item">
                    <figure aria-describedby="favourite-song-2">
                        <img loading="lazy" src="https://i.pinimg.com/564x/99/41/82/99418264794012ddd044c761919fbb44.jpg"
                            alt="Portada del álbum 'Punisher' de Phoebe Bridgers" width="120px" height="120px"
                            class="image-border" />
                        <figcaption>
                            <h4>Punisher</h4>
                            <h5>Phoebe Bridgers</h5>
                        </figcaption>
                        <button class="remove-favorite">
                            <i class="ph ph-trash-simple icon remove-favorite-icon"></i>
                            <span class="visually-hidden">Remover de favoritos</span>
                        </button>
                    </figure>
                </li>
                <li class="edit-favourite-item">
                    <figure aria-describedby="favourite-song-2">
                        <img loading="lazy" src="https://i.pinimg.com/564x/99/41/82/99418264794012ddd044c761919fbb44.jpg"
                            alt="Portada del álbum 'Punisher' de Phoebe Bridgers" width="120px" height="120px"
                            class="image-border" />
                        <figcaption>
                            <h4>Punisher</h4>
                            <h5>Phoebe Bridgers</h5>
                        </figcaption>
                        <button class="remove-favorite">
                            <i class="ph ph-trash-simple icon remove-favorite-icon"></i>
                            <span class="visually-hidden">Remover de favoritos</span>
                        </button>
                    </figure>
                </li>
                <li class="edit-favourite-item">
                    <button class="add-favorite">
                        <span>Agregar álbum a favoritos</span>
                        <i class="ph ph-music-notes-plus icon add-favorite-icon"></i>
                    </button>       
                </li>
            </ul>
        </section>

        <section class="edit-favourites">
            <h3 class="section-title">Canciones Favoritas</h3>
            <ul class="edit-favourites-list">
                <li class="edit-favourite-item">
                    <figure aria-describedby="favourite-song-4">
                        <img loading="lazy" src="https://i.pinimg.com/564x/3d/65/d5/3d65d5e4af0cde2458b2e7b55869f4e6.jpg"
                            alt="Portada del álbum 'Peso Pluma || Music Session' de Bizarrap" width="80px" height="80px"
                            class="image-border" />
                        <figcaption>
                            <h4>Peso Pluma</h4>
                            <h5>Bizarrap</h5>
                        </figcaption>
                        <button class="remove-favorite">
                            <i class="ph ph-trash-simple icon remove-favorite-icon"></i>
                            <span class="visually-hidden">Remover de favoritos</span>
                        </button>
                    </figure>
                </li>
                <li class="edit-favourite-item">
                    <figure aria-describedby="favourite-song-4">
                        <img loading="lazy" src="https://i.pinimg.com/564x/3d/65/d5/3d65d5e4af0cde2458b2e7b55869f4e6.jpg"
                            alt="Portada del álbum 'Peso Pluma || Music Session' de Bizarrap" width="80px" height="80px"
                            class="image-border" />
                        <figcaption>
                            <h4>Peso Pluma</h4>
                            <h5>Bizarrap</h5>
                        </figcaption>
                        <button class="remove-favorite">
                            <i class="ph ph-trash-simple icon remove-favorite-icon"></i>
                            <span class="visually-hidden">Remover de favoritos</span>
                        </button>                    
                    </figure>
                </li>
                <li class="edit-favourite-item">
                    <figure aria-describedby="favourite-song-4">
                        <img loading="lazy" src="https://i.pinimg.com/564x/3d/65/d5/3d65d5e4af0cde2458b2e7b55869f4e6.jpg"
                            alt="Portada del álbum 'Peso Pluma || Music Session' de Bizarrap" width="80px" height="80px"
                            class="image-border" />
                        <figcaption>
                            <h4>Peso Pluma</h4>
                            <h5>Bizarrap</h5>
                        </figcaption>
                        <button class="remove-favorite">
                            <i class="ph ph-trash-simple icon remove-favorite-icon"></i>
                            <span class="visually-hidden">Remover de favoritos</span>
                        </button>                    
                    </figure>
                </li>
                <li class="edit-favourite-item">
                    <button class="add-favorite">
                        <span>Agregar canción a favoritos</span>
                        <i class="ph ph-music-notes-plus icon add-favorite-icon"></i>
                    </button>       
                </li>
            </ul>
        </section>
    </main>
    <footer class="main-footer">
        <?php require "fragments/footer.view.php"?>
    </footer>
</body>

</html>