<?php
    require_once('User.php');
    if(session_status() == PHP_SESSION_NONE){ session_start();}

    $user = new User();


?>

<!doctype html>
<html lang="fr">
<head>
    <?php require_once('_include/head.php') ?>
    <title>Accueil</title>
</head>
<body>
    <header>
        <?php require_once('_include/header.php') ?>
    </header>
    <main>
        <h1 class="last-article-title">Last articles</h1>
        <article id="flex-article">
            <?php  $user->getLastArticles(); ?>
        </article>
    </main>
    <footer>
        <?php  require_once('_include/footer.php')  ?>
    </footer>
</body>
</html>
