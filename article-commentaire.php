<?php
    if(session_status() == PHP_SESSION_NONE){ session_start();}

    require_once ('_Class/Article.php');
    require_once ('_Class/Comment.php');


    $article = new Article();
    $comment = new Comment();


    if(isset($_GET['commentaire']))
    {
        $comment->getCommentaires();
    }



if(isset($_GET['commentaires'])) {
    $comment->insertComment($_POST['comment']);
}



?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once ('_include/head.php') ?>
    <script defer src="_js/article-commentaire.js"></script>
    <title>Article</title>
</head>
<body>
    <header>
        <?php require_once ('_include/header.php') ?>
    </header>
    <main>
        <?php
        if(isset($_GET['article'])) {
            $article->getArticles();
        }
        ?>
        <div id ="place">

        </div>
        <div id="displayComment">

        </div>
    </main>
    <footer>
        <?php require_once ('_include/footer.php')?>
    </footer>
</body>
</html>
