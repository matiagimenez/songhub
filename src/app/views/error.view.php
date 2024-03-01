<!DOCTYPE html>
<html lang="en">
<?php require "fragments/head.view.php"?>

<body>
    <?php require "fragments/header.view.php"?>
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