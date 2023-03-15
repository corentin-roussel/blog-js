<?php
    require_once('_Class/Article.php');
    if(session_status() == PHP_SESSION_NONE){ session_start();}

    $article = new Article();


?>

<!doctype html>
<html lang="fr">
<head>
    <?php require_once('_include/head.php') ?>
    <title>Accueil</title>
</head>
<body class="wrapper">
    <header class="page-header">
        <?php require_once('_include/header.php') ?>
    </header>
    <main class="page-body">
        <h1 class="last-article-title">Last articles</h1>
        <article id="flex-article">
            <?php  $article->getLastArticles(); ?>
        </article>
    </main>
    <footer class="page-footer">
        <?php  require_once('_include/footer.php')  ?>
    </footer>
</body>
</html>
