<?php
?>

<section class="about-blog">
    <h3 class="footer-title">A propos du blog</h3>
    <p class="footer-text">C'est un pargraphe de test</p>
</section>
<section class="link-blog">
    <h3 class="footer-title">Liens</h3>
    <?php
        if(isset($_SESSION)) {
    ?>
            <a class="footer-link" href="profil.php">Profil</a>
            <a class="footer-link" href="article.php">Article</a>
    <?php
        }else {
    ?>
            <a class="footer-link" href="index.php">Accueil</a>
            <a class="footer-link" href="authentification.php">S'authentifier</a>
    <?php
        }
    ?>

</section>
<section class="contact-blog">
    <h3 class="footer-title">Nous contacter</h3>
    <p class="footer-text">E-mail: gameblog@gmail.com</p>

</section>
