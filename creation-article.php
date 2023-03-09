<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once '_include/head.php' ?>
    <title>Document</title>
</head>
<body>

    <?php if (session_status() == PHP_SESSION_NONE){ session_start();} ?>
    <?php require_once 'Article.php' ?>

    <header>
        <?php require_once '_include/header.php' ?>
    </header>

    <main>

        <form action="" method="POST" id="creaArticleForm">

            <h2 class="creation-title">Create an article</h2>

            <label for="titre">Titre</label>
            <input class="input" type="text" name="titre" id="titre" required />
            <div id="errorTitre" class="error"></div>

            <label for="content">Content</label>
            <textarea class="input" name="content" required></textarea>
            <div id="errorContent" class="error"></div>

            <label for="categorie">Choose a category :</label>               <!-- Rajouter les catégories -->
            <select name="categorie" id="categorie">
                <option value="">--Category--</option>
                <option value="Categorie1">Categorie1</option>
                <option value="Categorie2">Categorie2</option>
                <option value="Categorie3">Categorie3</option>
                <option value="Categorie4">Categorie4</option>
            </select>
            <div id="errorCategorie" class="error"></div>

            <button class="button-form" type="submit" name="submit" id="publish">Publish article</button>
            <div id="success" class="success"></div>

        </form>

    </main>

    <footer>
        <?php require_once '_include/footer.php' ?>
    </footer>
    
</body>
</html>