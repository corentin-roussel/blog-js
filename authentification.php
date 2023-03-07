<?php
?>

<!doctype html>
<html lang="fr">
<head>
    <?php require_once('_include/head.php') ?>
    <title>Authentification</title>
</head>
<body>
    <header>
        <article id="flex-header">
            <?php require_once('_include/header.php') ?>
        </article>
    </header>
    <main>
        <article id="place">

        </article>
    </main>
    <footer>
        <article id="flex-footer">
            <?php require_once('_include/footer.php') ?>
        </article>
    </footer>
</body>
</html>

<div class="inscription-container">
    <form method="POST" id="formReg">
        
        <h2 class="footer-title">Inscription</h2>

        <label class="space footer-text" for="login">Login : </label>
        <input type="text" name="login" id="login">

        <label class="space footer-text" for="password">Mot de passe : </label>
        <input type="password" name="password" id="password">

        <label class="space footer-text" for="confpassword">Confirmation mot de passe : </label>
        <input type="password" name="confpassword" id="confpassword">

        <input class="button-form" type="submit" value="Inscription" id="inscription">
    </form>
</div>

<div class="connexion-container">
    <form method="POST" id="formCon">
        <h2 class="footer-title">Connexion</h2>

        <label class="space" for="login">Login : </label>
        <input type="text" name="login" id="login">

        <label class="space" for="password">Mot de passe : </label>
        <input type="password" name="password" id="password">

        <input class="button-form" type="submit" value="Connexion" id="connexion">
    </form>
</div>
