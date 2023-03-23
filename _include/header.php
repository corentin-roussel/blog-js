<div class="flex-header">
<!--    <div class="logo-header">-->
<!--        <img src="../_img/logo.jpg" alt="logo-controller">-->
<!--    </div>-->
    <div class="flex-link-header">
<?php
    if(isset($_SESSION['user'])) {
?>
        <a class="link" href="index.php">Home</a>
        <a class="link" href="profil.php">Profile</a>
        <a class="link" href="articles-page.php">Article</a>
        <?php if(isset ($_SESSION['user']['roles']) && $_SESSION['user']['roles'] == "admin"){ ?>
        <a class="link" href="admin.php">Admin</a>
        <?php } ?>
        <a class="link" id="disconnect" href="deconnexion.php">Disconnect</a>
<?php
    }else {
?>
        <a class="link" href="index.php">Home</a>
        <a class="link" href="authentification.php">Authenticate</a>

<?php
    }
?>
    </div>
</div>
