<?php ?>
<nav class="header-nav">
    <ul class="hidden" role="menu" id="main-menu">
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
            <a href="/profile" class="menu-item"> PERFIL </a>
        </li>
        <li role="menuitem" class="logout-item" aria-labelledby="logout-content">
            <button class="menu-item">
                <span id="logout-content">CERRAR SESION</span>
                <i class="ph ph-sign-out icon logout-icon"></i>
            </button>
        </li>
    </ul>
    <button class="menu-button menu-item" aria-expanded="false" aria-controls="main-menu">
        <span class="visually-hidden">Abrir menu</span>
        <i class="ph ph-list open-menu-icon"></i>
    </button>
</nav>