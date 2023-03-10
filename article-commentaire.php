<?php
    require_once ('Article.php');
    require_once ('Comment.php');

    $article = new Article();
    $comment = new Comment();




    if(isset($_GET['commentaire'])) {
        $comment->insertComment();
    }


?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once ('_include/head.php') ?>
    <script defer src="commentaire.js"></script>
    <title>Article</title>
</head>
<body>
    <header>
        <?php require_once ('_include/header.php') ?>
    </header>
    <main>
        <?php
        if(isset($_GET['article'])) {
            var_dump($_GET);
            $article->getArticles();
        }
        ?>
        <div id ="place">

        </div>
        <div id="button">
            <button id="switchComment">Comment</button>
        </div>
    </main>
    <footer>
        <?php require_once ('_include/footer.php')?>
    </footer>
</body>
</html>
