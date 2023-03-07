<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="module.css" />
    <script src="module.js" defer></script>
    <title>Document</title>
</head>

<?php require_once 'User.php' ?>

<body>
    <?php //require_once 'header.php' ?>
    <?php if (session_status() == PHP_SESSION_NONE){ session_start();} ?>

    <main id="main">

        <div id="buttons">
            <button id="switchInscription">Signup</button>
            <button id="switchConnexion">Login</button>
        </div>

        <div id="divForm"></div>

    </main>

    <?php //require_once 'footer.php' ?>

</body>

</html>