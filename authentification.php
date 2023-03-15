<?php
require_once '_Class/User.php';?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once('_include/head.php')?>
    <script defer src="_js/authentification.js"></script>
    <title>Authenticate</title>
</head>



<body>
    <header>
        <?php require_once '_include/header.php' ?>
    </header>

    <main id="main">

        <div id="buttons">
            <button id="switchInscription">Sign up</button>
            <button id="switchConnexion">Sign in</button>
        </div>

        <div id="divForm"></div>

    </main>
    <footer>
        <?php require_once '_include/footer.php' ?>
    </footer>

</body>

</html>