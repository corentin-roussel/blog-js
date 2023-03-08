<?php
require_once ('User.php');
if(session_status() == PHP_SESSION_NONE){ session_start();}

$user = new User();

if(isset($_GET['profile'])) {
    $user->Update($_POST['login'], $_POST['password'], $_POST['newPassword'], $_POST['newPasswordConfirm']);
}

?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once('_include/head.php') ?>
    <script defer src="profil.js"></script>
    <title>Profile</title>
</head>
<body>
    <header>
        <div class="flex-header">
            <?php require_once('_include/header.php') ?>
        </div>
    </header>
    <main>
        <div class="profile-container">
            <form action="#" method="POST" id="formProfile">
                <h2>Profile</h2>

                <label for="login">Login</label>
                <input type="text" name="login" id="login">
                <div id="errorLoginProfile" class="error"></div>

                <label for="password">Password</label>
                <input type="password" name="password" id="password">

                <label for="newPassword">New password</label>
                <input type="password" name="newPassword" id="newPassword">

                <label for="newPasswordConfirm">New password confirm</label>
                <input type="password" name="newPasswordConfirm" id="newPasswordConfirm">
                <div id="errorPassProfile" class="error"></div>

                <input type="submit" value="Update" name="submit" id="submitProfile">
            </form>
        </div>
    </main>
    <footer>
        <div class="flex-footer">
            <?php require_once('_include/footer.php') ?>
        </div>
    </footer>
</body>
</html>
