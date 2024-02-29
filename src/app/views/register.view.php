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
    <link rel="stylesheet" href="../styles/register.css" />
    <script src="../scripts/index.js" type="module"></script>
    <title>Registrate | SongHub</title>
</head>

<body>
    <main>
        <form action="/register" method="POST">
            <h1>Registrate</h1>
            <fieldset>
                <legend>Informacion de registro</legend>
                <p class="input-container">
                    <input name="username" id="username" type="text" required autocomplete="off" class="input"
                        aria-describedby="username-desc" aria-labelledby="username-label" />
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
                <button class="google-button">
                    <span>
                        <img src="../assets/icons/google.svg" alt="Google icon" />
                    </span>
                    Registrarse con Google
                </button>
            </p>
            <p class="link-container">
                Ya tenes cuenta?
                <a href="login.html">Inicía sesión aquí</a>
            </p>
        </form>
    </main>
</body>

</html>