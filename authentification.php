<?php
require_once '_Class/User.php';
if (session_status() == PHP_SESSION_NONE){ session_start();}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once('_include/head.php')?>
    <script defer src="_js/authentification.js"></script>
    <title>Authenticate</title>
</head>



<body class="wrapper">
    <header class="page-header">
        <?php require_once '_include/header.php' ?>
    </header>

    <main class="page-body" id="main">

        <div id="buttons">
            <button id="switchInscription" class="start-btn">Sign up</button>
            <button id="switchConnexion" class="start-btn">Sign in</button>
        </div>

        <div id="divForm"></div>

    </main>
    <footer class="page-footer">
        <?php require_once '_include/footer.php' ?>
    </footer>

</body>

</html>