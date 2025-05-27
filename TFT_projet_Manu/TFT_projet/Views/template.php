
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="public/css/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($title) ?></title>
</head>
<body>
<header>
    <!-- Menu -->
    <nav>
    </nav>
</header>
<!-- #contenu -->
<main id="contenu">
    <nav>
        <ul>
            <li><a href="index.php?action=add-unit">Ajouter une unité</a></li>
            <li><a href="index.php?action=add-origin">Ajouter une origine</a></li>
            <li><a href="index.php?action=search">Rechercher</a></li>
        </ul>
    </nav>
    <?=$this->section('content')?>

</main>
<footer>
</footer>
</body>
</html>

