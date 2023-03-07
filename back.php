<?php if(isset($_GET['inscription'])): ?>

    <form action="" method="POST" id="signupForm" class="form">

        <input type="text" name="login" id="login" placeholder="Enter your login" required />
        <div id="errorLogin" class="error"></div>

        <input type="password" name="password" placeholder="Enter your password" required />

        <input type="password" name="passwordConfirm" placeholder="Confirm your password" required />
        <div id="errorPass" class="error"></div>

        <button type="submit" name="submit" id="signup">Singup</button>

    </form>

<?php die (); endif ?>


<?php if(isset($_GET['connexion'])): ?>

    <form action="" method="POST" id="signinForm" class="form">

        <input type="text" name="login" id="login" placeholder="Enter your login" required />
        <div id="errorLogin" class="error"></div>

        <input type="password" name="password" placeholder="Enter your password" required />
        <div id="errorPass" class="error"></div>

        <button type="submit" name="submit" id="signin">Singin</button>

    </form>

<?php die(); endif ?>

<?php

require_once 'User.php';
$user = new User();

if(isset($_GET['signup'])) {

    $user->Register($_POST['login'], $_POST['password'], $_POST['passwordConfirm']);

}

if(isset($_GET['signin'])) {

    $user->Connect($_POST['login'], $_POST['password']);

}

?>
