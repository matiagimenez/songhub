<!DOCTYPE html>
<html lang="es">

<head>
    <?php require "fragments/head.view.php"?>
</head>

<body>
    <main>
        <form action="/register" method="POST">
            <h1>Registrate</h1>
            <fieldset>
                <legend>Informacion de registro</legend>
                <p class="input-container">
                    <input name="username" id="username" type="text" required autocomplete="off" class="input"
                        aria-describedby="username-desc" aria-labelledby="username-label" maxlength="20" />
                    <label for="username" id="username-label">Nombre de usuario</label>
                <p class="visually-hidden" id="username-desc">El nombre de usuario solo puede estar conformado por
                    letras y numeros</p>
                </p>
                <p class="input-container">
                    <input name="email" id="email" type="email" required autocomplete="off" class="input"
                        aria-labelledby="email-label" />
                    <label for="email" id="email-label">Correo electrónico</label>
                </p>
                <p class="input-container">
                    <input name="email-confirmation" id="email-confirmation" type="email" autocomplete="off" required
                        class="input" aria-labelledby="email-confirmation-label" />
                    <label for="email-confirmation" id="email-confirmation-label">Confirmar correo electrónico</label>
                </p>
                <p class="input-container">
                    <input id="password" name="password" type="password" required class="input"
                        aria-describedby="password-desc" aria-labelledby="password-label" />
                    <label for="password" id="password-label">Contraseña</label>
                <p class="visually-hidden" id="password-desc">La contraseña debe incluir letras y numeros</p>
                </p>
                <p class="input-container">
                    <input id="password-confirmation" name="password-confirmation" type="password" required
                        class="input" aria-describedby="password-desc" aria-labelledby="password-confirmation-label" />
                    <label for="password-confirmation" id="password-confirmation-label">Confirmar contraseña</label>
                <p class="visually-hidden" id="password-desc">La contraseña debe incluir letras y numeros</p>
                </p>
            </fieldset>
            <p class="button-container">
                <input type="submit" class="submit-button" value="Crear cuenta" />
                <button class="spotify-button sign-up-spotify" type="button">
                    <span>
                        <img src="/assets/icons/spotify.svg" alt="Spotify icon" />
                    </span>
                    Registrarse con Spotify
                </button>
            </p>
            <p class="link-container">
                Ya tenes cuenta?
                <a href="/login">Inicía sesión aquí</a>
            </p>
        </form>
    </main>
</body>

</html>