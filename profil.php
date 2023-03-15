<?php
require_once ('_Class/User.php');
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
    <script defer src="_js/profil.js"></script>
    <title>Profile</title>
</head>
<body>
    <header>
            <?php require_once('_include/header.php') ?>
    </header>
    <main>
        <div class="profile-container">
            <form action="#" method="POST" id="formProfile">
                <h2 class="title-profile">Profile</h2>

                <label class="space text-profile" for="login">Login</label>
                <input class="input" type="text" name="login" id="login" value="<?php if(isset($_SESSION['user'])) { echo $_SESSION['user']['login'];} ?>">
                <div id="errorLoginProfile" class="error"></div>

                <label class="space text-profile" for="password">Password</label>
                <input class="input" type="password" name="password" id="password">

                <label class="space text-profile" for="newPassword">New password</label>
                <input class="input" type="password" name="newPassword" id="newPassword">

                <label class="space text-profile" for="newPasswordConfirm">New password confirm</label>
                <input class="input" type="password" name="newPasswordConfirm" id="newPasswordConfirm">
                <div id="errorPassProfile" class="error"></div>

                <input class="button-form" type="submit" value="Update" name="submit" id="submitProfile">
            </form>
        </div>
    </main>
    <footer>
            <?php require_once('_include/footer.php') ?>
    </footer>
</body>
</html>
