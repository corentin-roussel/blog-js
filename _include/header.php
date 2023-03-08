<?php
    if(isset($_SESSION['user'])) {
?>
        <a class="link" href="profil.php">Profile</a>
        <a class="link" href="article.php">Article</a>
<?php
    }else {
?>
        <a class="link" href="index.php">Home</a>
        <a class="link" href="authentification.php">Authenticate</a>

<?php
    }
?>
