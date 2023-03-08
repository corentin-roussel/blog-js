<?php
?>

<section class="about-blog">
    <h3 class="footer-title">About the blog</h3>
    <p class="footer-text">This is a test paragraph</p>
</section>
<section class="link-blog">
    <h3 class="footer-title">Link</h3>
    <?php
        if(isset($_SESSION['user'])) {
    ?>
            <a class="footer-link" href="profil.php">Profile</a>
            <a class="footer-link" href="article.php">Article</a>
    <?php
        }else {
    ?>
            <a class="footer-link" href="index.php">Home</a>
            <a class="footer-link" href="authentification.php">Authenticate</a>
    <?php
        }
    ?>

</section>
<section class="contact-blog">
    <h3 class="footer-title">Contact us</h3>
    <p class="footer-text">E-mail: gameblog@gmail.com</p>

</section>
