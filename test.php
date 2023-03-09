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

    var_dump($noms);

    for ($i=0; isset($noms[$i]); $i++) { 
        
        foreach ($noms[$i] as $key => $value) {

            echo $key;
            echo $value;

            // echo '<option value="' . $value . '">' . $value . '</option>';

        }
    }


?>