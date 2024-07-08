<?php
use Songhub\core\Session;

$isAuthenticated = Session::getInstance()->exists("username");

if ($isAuthenticated) {
    $username = Session::getInstance()->get("username");

}

?>
<nav class="header-nav">
    <ul class="hidden" role="menu" id="main-menu">

        <?php if ($isAuthenticated): ?>
        
        <li role="menuitem">
            <a href="/" class="menu-item">INICIO</a>
        </li>
        <li role="menuitem">
            <a href="/explore" class="menu-item">EXPLORAR</a>
        </li>
        <li role="menuitem">
            <a href=<?="/user?username=" . $username?> class="menu-item"> PERFIL </a>
        </li>
        <li role="menuitem" class="logout-item" aria-labelledby="logout-content">
            <button class="menu-item logout-button">
                <!-- <span id="logout-content">CERRAR SESION</span> -->
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