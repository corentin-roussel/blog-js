<?php if(session_status() == PHP_SESSION_NONE){ session_start();} ?>

<script defer src="_js/deconnexion.js"></script>

<h2>Wait here you're going to be redirected <a class="link" id="disconnect" href="authentification.php">if you're not redirected click here.</a></h2>
<?php


require_once ('_Class/User.php');

User::Disconnect();
?>


