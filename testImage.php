<?php

    require_once '_Class/User.php';

    $user = new User();

    // $user->setPP('profil.php')
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="testImage.js" defer></script>
    <title>Test</title>
</head>

<body>

    <img id="profileImage" src="data:image/<?php echo $user->getPPformat() ?>;base64,<?php echo $user->getPP(); ?>" width="50px" height="50px"/>

    <form id="changePPform">

        <label for="picture">Change your profil picture :</label>
        <input type="file" id="picture" name="picture" accept="image/png, image/jpeg, image/webp, image/jpg">

        <button type="submit">Change</button>

    </form>

</body>

</html>

<?php //$user->unsetPP() ?>