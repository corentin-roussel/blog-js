<?php
    require_once('User.php');
    if(session_status() == PHP_SESSION_NONE){ session_start();}

    $user = new User();

    $display = $user->getLastArticles();

    foreach($display as $key => $values) {
        var_dump($key);
        var_dump($values);
    }

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
        <article id="flex-article">
            <h1>Derniers articles.</h1>
            <section class="article-place">
                <h2 class="article-title">Diablo 4 ça donne quoi ?</h2>
                <p class="article-text"><small>News, beta, blizzard.</small></p>
<!--                <p class="article-text">Attention à la déception : Diablo 4 ne sortira probablement pas avant 2022 voir, 2023. Lors d’une session autour du jeu à la Blizzcon 2019, le directeur du jeu avait déclaré qu’il ne s’attendait pas à ce que le jeu soit terminé de sitôt, « même avec les normes actuelles de Blizzard ».</p>-->
            </section>
            <section class="article-place">
                <h2 class="article-title">Hollow knight Silksong c'est pour quand ?</h2>
                <p class="article-text"><small>News, date de sortie, coup de coeur, Team Cherry</small></p>
<!--                <p class="article-text">Silksong est l’objet de tous les fantasmes des amateurs du premier jeu, tout comme sa date de sortie. Annoncé en 2019, la suite d’Hollow Knight se fait très largement attendre, mais elle devrait bel et bien sortir au cours de la première moitié de 2023.</p>-->
            </section>
            <section class="article-place">
                <h2 class="article-title">Octopath Traveller 2 digne successeur du premier opus ?</h2>
                <p class="article-text"><small>Test, jrpg, 2D</small></p>
<!--                <p class="article-text">En dépoussiérant le jeu de rôle dit « old school » de manière grandiose, Octopath Traveler démontrait en 2018 que les RPG à l’ancienne avaient encore un très bel avenir. Ce nouvel opus le prouve à nouveau en nous contant 8 destinées inédites à découvrir sur Switch mais aussi sur PS5, PS4 et PC.</p>-->
            </section>
        </article>
    </main>
    <footer>
        <?php  require_once('_include/footer.php')  ?>
    </footer>
</body>
</html>
