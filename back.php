<?php
    require_once 'User.php';
    require_once 'Article.php';
    if(session_status() == PHP_SESSION_NONE){ session_start();}
?>


<?php if(isset($_GET['inscription'])): ?>
<div class="inscription-container">
    <form action="" method="POST" id="signupForm" class="form">
        <h2 class="register-title">Sign up</h2>

        <label class="space register-text" for="login">Login</label>
        <input class="input" type="text" name="login" id="login" placeholder="Enter your login" required />
        <div id="errorLogin" class="error"></div>

        <label class="space register-text" for="password">Password</label>
        <input class="input" type="password" name="password" placeholder="Enter your password" required />

        <label class="space register-text" for="confpassword">Password confirmation</label>
        <input class="input" type="password" name="passwordConfirm" placeholder="Confirm your password" required />
        <div id="errorPass" class="error"></div>

        <button class="button-form" type="submit" name="submit" id="signup">Sign up</button>
    </form>
</div>
<?php die (); endif ?>


<?php if(isset($_GET['connexion'])): ?>
<div class="connexion-container">
    <form action="" method="POST" id="signinForm" class="form">
        <h2 class="conn-title">Sign in</h2>

        <label class="space conn-text" for="login">Login</label>
        <input class="input" type="text" name="login" id="login" placeholder="Enter your login" required />
        <div id="errorLogin" class="error"></div>

        <label class="space conn-text" for="password">Password</label>
        <input class="input" type="password" name="password" placeholder="Enter your password" required />
        <div id="errorPass" class="error"></div>

        <button class="button-form" type="submit" name="submit" id="signin">Sign in</button>

    </form>
</div>
<?php die(); endif ?>


<?php

$user = new User();

if(isset($_GET['signup'])) {

    $user->Register($_POST['login'], $_POST['password'], $_POST['passwordConfirm']);

}

if(isset($_GET['signin'])) {

    $user->Connect($_POST['login'], $_POST['password']);

}

?>


<?php

$article = new Article();

if(isset($_GET['create'])) {

    $article->checkArticle($_POST['content'], $_POST['titre'], $_POST['categorie']);

}

if(isset($_GET['displayArt'])) {

    if(isset($_GET['numPage'])) {
        $numPage = $_GET['numPage'];
    }

    if(isset($_POST['nbArticles']) && isset($_POST['listeCategorie'])) {

        $article->getArticlesListe($_POST['nbArticles'], $numPage, $_POST['listeCategorie']);

    }elseif (isset($_POST['nbArticles']) && !isset($_POST['listeCategorie'])) {

        $article->getArticlesListe($_POST['nbArticles'], $numPage, "");

    }elseif (!isset($_POST['nbArticles']) && isset($_POST['listeCategorie'])) {

        $article->getArticlesListe(5, $numPage, $_POST['listeCategorie']);

    }else{
        $article->getArticlesListe(5, $numPage, "");
    }

}

if(isset($_GET['displayPagination'])) {

    if(isset($_POST['nbArticles']) && isset($_POST['listeCategorie'])) {

        $article->pagination($_POST['nbArticles'], $_POST['listeCategorie']);

    }elseif (!isset($_POST['nbArticles']) && isset($_POST['listeCategorie'])) {
        
        $article->pagination(5, $_POST['listeCategorie']);

    }elseif (isset($_POST['nbArticles']) && !isset($_POST['listeCategorie'])) {
        
        $article->pagination($_POST['nbArticles'], "");

    }else{

        $article->pagination(5, "");

    }

}

?>