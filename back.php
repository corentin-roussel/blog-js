<?php if(isset($_GET['inscription'])): ?>

    <!-- <button name="login" id="switchConnexion">Login</button> -->

    <form action="" method="POST" id="signupForm">

        <input type="text" name="login" id="login" placeholder="Enter your login" required /><br>
        <div id="errorLogin" class="error"></div>

        <input type="password" name="password" placeholder="Enter your password" required /><br>

        <input type="password" name="passwordConfirm" placeholder="Confirm your password" required /><br>
        <div id="errorPass" class="error"></div>

        <button type="submit" name="submit" id="signup">Singup</button>
        <div id="okReg" class="success"></div>

    </form>

<?php die (); endif ?>


<?php if(isset($_GET['connexion'])): ?>

    <!-- <button name="signup" id="switchInscription">Signup</button> -->

    <form action="" method="POST" id="signinForm">

        <input type="text" name="login" id="login" placeholder="Enter your login" required /><br>
        <div id="errorLogin" class="error"></div>

        <input type="password" name="password" placeholder="Enter your password" required /><br>
        <div id="errorPass" class="error"></div>

        <button type="submit" name="submit" id="signin">Singin</button>
        <div id="okConn" class="success"></div>

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
