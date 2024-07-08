<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "fragments/head.view.php"?>
</head>

<body>
    <header class="main-header" id="main-header">
        <?php require "fragments/header.view.php"?>
    </header>

    <main>
        <header>
            <form action="">
                <label for="search-on-page">Buscar álbum, canción o artista</label>
                <input type="search" name="search" role="searchbox" id="search-on-page" autocomplete="off" class="input"
                    aria-describedby="search-description" />
                <p id="search-description" class="visually-hidden">
                    Los resultados de la búsqueda aparecerán en un momento.
                </p>
            </form>
            <!-- <h2>Resultados de la búsqueda para <span>'P'</span></h2>
            <p>
                <input type="radio" name="category" id="all" value="all" checked />
                <label for="all">Todos</label>
                <input type="radio" name="category" id="album" value="album" />
                <label for="album">Álbum</label>
                <input type="radio" name="category" id="song" value="song" />
                <label for="song">Canción</label>
            </p> -->
        </header>

        <section id="tacks-results" class="section">
            <!-- Aquí se insertarán los resultados de la búsqueda -->
        </section>
        
        <section id="albums-results" class="section">
            <!-- Aquí se insertarán los resultados de la búsqueda -->
        </section>

    </main>

    <footer class="main-footer">
        <?php require "fragments/footer.view.php"?>
    </footer>
</body>

</html>