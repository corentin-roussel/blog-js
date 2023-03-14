<?php
    require_once 'User.php';
    require_once 'Article.php';
    require_once 'Comment.php';
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











<?php if(isset($_GET['utilisateurs'])) {

    $db_username = 'root';
    $db_password = '';

    try{
        $conn = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Error : " . $e->getMessage();
    }

    $sqlUsers = "SELECT *, utilisateurs.id FROM utilisateurs INNER JOIN roles ON utilisateurs.id_roles = roles.id";
    $reqUsers = $conn->prepare($sqlUsers);
    $reqUsers->execute();
    $tabUsers = $reqUsers->fetchAll(PDO::FETCH_ASSOC);

    $sqlRoles = "SELECT id, droits FROM roles";
    $reqRoles = $conn->prepare($sqlRoles);
    $reqRoles->execute();
    $tabRoles = $reqRoles->fetchAll(PDO::FETCH_ASSOC);

    var_dump($tabUsers['0']);
    var_dump($tabRoles['0']);

    foreach ($tabUsers as $user) : ?>

        <div class="uneLigneUser">

            <form class="form" id="<?php echo $user['id'] ?>">

                <label for="<?php echo $user['id'] ?>"><?php echo $user['login'] ?></label>
                <select name="<?php echo $user['id'] ?>">

                    <option value=""><?php echo $user['droits'] ?></option>

                    <?php foreach ($tabRoles as $role) : 
                        
                        if($role['droits'] != $user['droits']) : ?>

                            <option value="<?php echo $role['droits'] ?>"><?php echo $role['droits'] ?></option>

                        <?php endif;
                        
                    endforeach; ?>

                </select>

                <button type="submit">Change role</button>

            </form>

            <button class="suppr" id="<?php echo $user['id'] ?>">Delete user</button>

        </div>

    <?php endforeach;

} ?>



<?php if(isset($_GET['commentaires'])): ?>

<?php die(); endif ?>



<?php if(isset($_GET['articles'])): ?>

<?php die(); endif ?>



<?php if(isset($_GET['categories'])): ?>

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