<?php if (session_status() == PHP_SESSION_NONE){ session_start();} ?>
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

    $sql = ("SELECT *,utilisateurs.id FROM utilisateurs INNER JOIN roles ON utilisateurs.id_roles = roles.id WHERE utilisateurs.id = :userId");
    $req = $conn->prepare($sql);
    $req->execute(array(':userId' => $_SESSION['user']['id']));
    $tabUserRole = $req->fetchAll(PDO::FETCH_ASSOC);

    if(!$_SESSION['user'] || $tabUserRole[0]['utilisateurs'] === 0 && $tabUserRole[0]['commentaires'] === 0 && $tabUserRole[0]['articles'] === 0 && $tabUserRole[0]['categories'] === 0) {

        header('Location: index.php');

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once '_include/head.php' ?>
    <script src="_js/admin.js" defer></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

    <header>
        <?php require_once '_include/header.php' ?>
    </header>

    <main>

        <nav>
            <ul>
                <?php echo $tabUserRole[0]['utilisateurs'] == 1 ? "<li id='changeUser'>Users</li>" : "" ?>
                <?php echo $tabUserRole[0]['commentaires'] == 1 ? "<li id='changeCom'>Comments</li>" : "" ?>
                <?php echo $tabUserRole[0]['articles'] == 1 ? "<li id='changeArt'>Articles</li>" : "" ?>
                <?php echo $tabUserRole[0]['categories'] == 1 ? "<li id='changeCat'>Categories</li>" : "" ?>
            </ul>
        </nav>

        <div id="contenu"></div>
        
    </main>

    <footer>
        <?php require_once '_include/footer.php' ?>
    </footer>
    
</body>
</html>