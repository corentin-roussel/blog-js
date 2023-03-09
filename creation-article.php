<?php if (session_status() == PHP_SESSION_NONE){ session_start();} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once '_include/head.php' ?>
    <script src="creation-article.js" defer></script>
    <title>Document</title>
</head>
<body>


    <?php require_once 'Article.php' ?>

    <header>
        <?php require_once '_include/header.php' ?>
    </header>

    <main>

        <div class="creation-container">

            <form action="" method="POST" id="creaArticleForm">

                <h2 class="title-creation">Create an article</h2>

                <label for="titre" class="space text-creation">Titre</label>
                <input class="input" type="text" name="titre" id="titre" required />
                <div id="errorTitre" class="error"></div>

                <label for="content" class="space text-creation">Content</label>
                <textarea class="input" name="content" id="content" required></textarea>
                <div id="errorContent" class="error"></div>

                <label for="categorie" class="space text-creation">Choose a category :</label>                          <!-- Rajouter les catégories -->
                <select name="categorie" id="categorie">        <!-- avec une boucle php? -->
                    <option value="" class="selestCategorie">--Category--</option>

                    <?php
                        $db_username = 'root';
                        $db_password = '';

                        try{
                            $conn = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', $db_username, $db_password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        }
                        catch(PDOException $e){
                            echo "Error : " . $e->getMessage();
                        }

                        $sql = "SELECT nom FROM categories";
                        $req = $conn->prepare($sql);
                        $req->execute();
                        $noms = $req->fetchAll(PDO::FETCH_CLASS);
                    
                        for ($i=0; isset($noms[$i]); $i++) { 
                            foreach ($noms[$i] as $value) {
                    
                                echo '<option value="' . $value . '">' . $value . '</option>';
                    
                            }
                        }
                    ?>

                </select>
                <div id="errorCategorie" class="error"></div>

                <button class="button-form" type="submit" name="submit" id="publish">Publish article</button>

            </form>

        </div>

    </main>

    <footer>
        <?php require_once '_include/footer.php' ?>
    </footer>
    
</body>
</html>