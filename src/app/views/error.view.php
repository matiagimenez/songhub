<!DOCTYPE html>
<html lang="en">
<?php require "fragments/head.view.php"?>

<body>
    <header class="main-header" id="main-header">
        <?php require "fragments/header.view.php"?>
    </header>
    <main>
        <h2>ERROR <?=$errorType?></h2>
        <h3><?=$errorMessage?></h3>
        <h4>Opps! Algo salió mal</h4>
        <img src="/assets/images/error/error.jpg" alt="Error. Imagen de glitch" width="500" height="300" />
        <a href="/">
            Volver al inicio
        </a>
    </main>
    <footer class="main-footer">
        <?php require "fragments/footer.view.php"?>
    </footer>
</body>

</html>