<?php if (session_status() == PHP_SESSION_NONE){ session_start();} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once '_include/head.php' ?>
    <script src="articles-page.js" defer></script>
    <title>Document</title>
</head>
<body>


    <?php require_once 'Article.php' ?>

    <header>
        <?php require_once '_include/header.php' ?>
    </header>

    <main>

        <div class="liste-container">

            <form action="" method="POST" id="listeArticleForm">

                <label for="listeCategorie" class="space text-liste">Category :</label>
                <select name="listeCategorie" id="listeCategorie">
                    <option value="" class="selectCategorie">All</option>

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

                <label for="categorie" class="space text-liste">Articles per page :</label>
                <select name="nbArticles" id="nbArticles">
                    <option value="5" class="nbArticles">5</option>
                    <option value="10" class="nbArticles">10</option>
                    <option value="15" class="nbArticles">15</option>
                    <option value="20" class="nbArticles">20</option>
                </select>

                <button class="button-form" type="submit" name="submit" id="filter">Filter</button>

            </form>

        </div>

        <div id="displayListe">

            <?php
                if(!isset($_GET['pagination'])) {
                    $numPage = 1;
                }else{
                    $numPage = $_GET['pagination'];
                }
            ?>

            <article id="flex-article"></article>

        </div>

        <div id="pagination"></div>

    </main>

    <footer>
        <?php require_once '_include/footer.php' ?>
    </footer>
    
</body>
</html>