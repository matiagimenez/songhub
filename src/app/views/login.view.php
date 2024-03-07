<!DOCTYPE html>
<html lang="es">

<head>
    <?php require "fragments/head.view.php"?>
</head>

<body>
    <main>
        <form action="/login" method="POST">
            <header>
                <h1>Bienvenido</h1>
                <h2>Por favor, ingresa tus credenciales</h2>
            </header>
            <fieldset>
                <legend>Informacion de inicio de sesión</legend>
                <p class="input-container">
                    <input name="email" id="email" type="email" autocomplete="off" placeholder=" " required
                        class="input" aria-labelledby="email-label" />
                    <label for="email" id="email-label">Correo electrónico</label>
                </p>
                <p class="input-container">
                    <input id="password" name="password" type="password" required class="input"
                        aria-labelledby="password-label" />
                    <label for="password" id="password-label">Contraseña</label>
                </p>
                <a href="#">Recuperar contraseña</a>
            </fieldset>
            <p class="button-container">
                <input type="submit" class="submit-button" value="Iniciar sesión" />
                <button class="spotify-button">
                    <span>
                        <img src="/assets/icons/spotify.svg" alt="Icono de Spotify " />
                    </span>
                    Acceder con Spotify
                </button>
            </p>
            <p class="link-container">
                No tenes cuenta?
                <a href="/register">Registrate aquí</a>
            </p>
        </form>
    </main>
</body>

</html>