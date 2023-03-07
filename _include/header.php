<?php
    if(isset($_SESSION)) {
?>
        <a class="link" href="profil.php">Profil</a>
        <a class="link" href="article.php">Article</a>
<?php
    }else {
?>
        <a class="link" href="index.php">Accueil</a>
        <a class="link" href="authentification.php">S'authentifier</a>

<?php
    }
?>
