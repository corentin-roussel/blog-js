<?php require_once 'User.php';?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once('_include/head.php')?>
    <script defer src="authentification.js"></script>
    <title>Authenticate</title>
</head>



<body>
    <header>
        <article id="flex-header">
            <?php require_once '_include/header.php' ?>
        </article>
    </header>

    <main id="main">

        <div id="buttons">
            <button id="switchInscription">Sign up</button>
            <button id="switchConnexion">Sign in</button>
        </div>

        <div id="divForm"></div>

    </main>
    <footer>
        <article id="flex-footer">
            <?php require_once '_include/footer.php' ?>
        </article>
    </footer>

</body>

</html>