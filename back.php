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

    foreach ($tabUsers as $user) : ?>

        <div class="uneLigne">

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

            <button class="suppr" id="supprUser<?php echo $user['id'] ?>">Delete user</button>

        </div>

    <?php endforeach;

}
?>



<?php if(isset($_GET['commentaires'])) {

    $db_username = 'root';
    $db_password = '';

    try{
        $conn = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Error : " . $e->getMessage();
    }

    $sqlComm = "SELECT *, commentaires.id, commentaires.contenu, commentaires.date_creation FROM commentaires INNER JOIN utilisateurs ON utilisateurs.id = commentaires.id_utilisateur INNER JOIN articles ON articles.id = commentaires.id_article ORDER BY commentaires.date_creation DESC";
    $reqComm = $conn->prepare($sqlComm);
    $reqComm->execute();
    $tabComm = $reqComm->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tabComm as $comm) : ?>

        <div class="uneLigne">

            <p>Date : <?php echo $comm['date_creation'] ?></p>
            <p>Auteur : <?php echo $comm['login'] ?></p>
            <p>Article : <?php echo $comm['titre'] ?></p>

        </div>

        <p>Contenu : <?php echo $comm['contenu'] ?></p>

        <button class="modif" id="modifComm<?php echo $comm['id'] ?>">Mofify comment</button>
        <button class="suppr" id="supprComm<?php echo $comm['id'] ?>">Delete comment</button>
        
    <?php endforeach;

} ?>



<?php if(isset($_GET['articles'])) {

    $db_username = 'root';
    $db_password = '';

    try{
        $conn = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Error : " . $e->getMessage();
    }

    $sqlArt = "SELECT *, articles.id FROM articles INNER JOIN utilisateurs ON utilisateurs.id = articles.id_utilisateur INNER JOIN categories ON categories.id = articles.id_categorie ORDER BY articles.date_creation DESC";
    $reqArt = $conn->prepare($sqlArt);
    $reqArt->execute();
    $tabArt = $reqArt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tabArt as $article) : ?>

        <h4><?php echo $article['titre'] ?></h4>
        <p><?php echo $article['nom'] ?></p>
        
        <div class="uneLigne">

            <p><?php echo $article['login'] ?></p>
            <p><?php echo $article['date_creation'] ?></p>

        </div>

        <p>Contenu : <?php echo $article['contenu'] ?></p>

        <button class="modif" id="modifArt<?php echo $article['id'] ?>">Mofify article</button>
        <button class="suppr" id="supprArt<?php echo $article['id'] ?>">Delete article</button>

    <?php endforeach;

} ?>



<?php if(isset($_GET['categories'])) {

    $db_username = 'root';
    $db_password = '';

    try{
        $conn = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Error : " . $e->getMessage();
    }

    $sqlCat = "SELECT * FROM categories";
    $reqCat = $conn->prepare($sqlCat);
    $reqCat->execute();
    $tabCat = $reqCat->fetchAll(PDO::FETCH_ASSOC);

    var_dump($tabCat[0]) ?>

    <div class="displayCategorie">

        <?php foreach ($tabCat as $categorie) : ?>

            <p><?php echo $categorie['nom'] ?></p>

            <button class="modif" id="modifCat<?php echo $categorie['id'] ?>">Modify category</button>

            <button class="suppr" id="spprCat<?php echo $categorie['id'] ?>">Delete category</button>
            
        <?php endforeach ?>

    </div>

    <div class="ajoutCategorie">

        <form class="form">

            <input type="text" name="addCat" id="addCat">
            <button type="submit">Create a category</button>

        </form>

    </div>

<?php } ?>










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

    echo 'oki';

    if(isset($_GET['numPage'])) {
        $numPage = $_GET['numPage'];
        echo 'ok1';
    }

    if(isset($_POST['nbArticles']) && isset($_POST['listeCategorie'])) {

        $article->getArticlesListe($_POST['nbArticles'], $numPage, $_POST['listeCategorie']);
        echo 'ok2';

    }elseif (isset($_POST['nbArticles']) && !isset($_POST['listeCategorie'])) {

        $article->getArticlesListe($_POST['nbArticles'], $numPage, "");
        echo 'ok3';

    }elseif (!isset($_POST['nbArticles']) && isset($_POST['listeCategorie'])) {

        $article->getArticlesListe(5, $numPage, $_POST['listeCategorie']);
        echo 'ok4';

    }else{
        $article->getArticlesListe(5, $numPage, "");
        echo 'ok5';
    }

}

if(isset($_GET['displayPagination'])) {

    echo 'oke';

    if(isset($_POST['nbArticles']) && isset($_POST['listeCategorie'])) {

        $article->pagination($_POST['nbArticles'], $_POST['listeCategorie']);
        echo 'ok6';

    }elseif (!isset($_POST['nbArticles']) && isset($_POST['listeCategorie'])) {
        
        $article->pagination(5, $_POST['listeCategorie']);
        echo 'ok7';

    }elseif (isset($_POST['nbArticles']) && !isset($_POST['listeCategorie'])) {
        
        $article->pagination($_POST['nbArticles'], "");
        echo 'ok8';

    }else{

        $article->pagination(5, "");
        echo 'ok9';

    }

}

?>