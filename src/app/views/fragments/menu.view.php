<?php
use Songhub\core\Session;

$isAunthenticated = Session::getInstance()->exists("username");

if ($isAunthenticated) {
    $username = Session::getInstance()->get("username");
}

?>
<nav class="header-nav">
    <ul class="hidden" role="menu" id="main-menu">

        <?php if ($isAunthenticated): ?>
        <li role="menuitem" class="search-item">
            <form action="/search" method="GET">
                <label for="search">Buscar álbum, canción o artista</label>
                <input type="search" name="search" role="searchbox" placeholder="Buscar álbum, canción o artista"
                    id="search" autocomplete="off" class="input menu-item" aria-describedby="search-description" />
                <p id="search-description" class="visually-hidden">
                    Los resultados de la búsqueda aparecerán en un momento.
                </p>
            </form>
        </li>
        <li role="menuitem">
            <a href="/" class="menu-item">INICIO</a>
        </li>
        <li role="menuitem">
            <a href="/explore" class="menu-item">EXPLORAR</a>
        </li>
        <li role="menuitem">
            <a href=<?="/profile/" . $username?> class="menu-item"> PERFIL </a>
        </li>
        <li role="menuitem" class="logout-item" aria-labelledby="logout-content">
            <button class="menu-item logout-button">
                <span id="logout-content">CERRAR SESION</span>
                <i class="ph ph-sign-out icon logout-icon"></i>
            </button>
        </li>
        <?php else: ?>
        <li role="menuitem">
            <a href="/login" class="menu-item">INICIAR SESIÓN</a>
        </li>
        <li role="menuitem">
            <a href="/register" class="menu-item">REGISTRARME</a>
        </li>
        <?php endif?>
    </ul>
    <button class="menu-button menu-item" aria-expanded="false" aria-controls="main-menu">
        <span class="visually-hidden">Abrir menu</span>
        <i class="ph ph-list open-menu-icon"></i>
    </button>
</nav>