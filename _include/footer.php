<?php
?>

<section class="about-blog">
    <h3>A propos de nous</h3>
    <p>C'est un pargraphe de test</p>
</section>
<section class="link-blog">
    <?php
        if(isset($_SESSION)) {
    ?>
            <a class="link" href="profil.php">Profil</a>
            <a class="link" href="article.php">Article</a>
    <?php
        }else {
    ?>
            <a href="index.php">Accueil</a>
            <a href="authentification.php">S'authentifier</a>
    <?php
        }
    ?>

</section>
<section class="contact-blog">

</section>
