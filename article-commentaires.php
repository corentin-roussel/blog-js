<?php
    require_once ('Article.php');
    if(session_status() == PHP_SESSION_NONE){ session_start();}

    $articles = new Article();
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once ('_include/head.php')?>

    <title>Articles</title>
</head>
<body>
    <header>
        <?php require_once ('_include/header.php')?>
    </header>
    <main>
        <?php echo $articles->getShortArticles(); ?>
    </main>
    <footer>
        <?php require_once ('_include/footer.php')?>
    </footer>
</body>
</html>