<?php

use Songhub\core\Request;
$request = Request::getInstance();

$url = $request->protocol() . "://" . $request->host();

if (str_contains($_SERVER['REQUEST_URI'], "/content") || str_contains($_SERVER['REQUEST_URI'], "/post")) {
    $url .= $request->path();
} else {
    $url .= "/";
}
?>

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
<meta property='og:url' content=<?=$url?> />
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="icon" type="image/x-icon" href="/assets/icons/favicon.svg" />
<link rel="stylesheet" href="/styles/<?=$style?>.css" />
<script src="/scripts/index.js" type="module"></script>
<script src="https://unpkg.com/@phosphor-icons/web"></script>
<title>
    <?=$title?> | SongHub
</title>