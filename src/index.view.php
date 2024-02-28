<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend | Home</title>
</head>

<body>
    <h1><?=$title?></h1>
    <nav>
        <ul>
            <?php foreach ($menu as $menuitem): ?>
            <li>
                <a href="<?=$menuitem["href"]?>"><?=$menuitem["text"]?></a>
            </li>
            <?php endforeach;?>
        </ul>
    </nav>

</body>

</html>