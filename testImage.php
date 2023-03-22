<?php

    require_once '_Class/User.php';

    $user = new User();
    
    //$user->setPP('https://img-19.commentcamarche.net/cI8qqj-finfDcmx6jMK6Vr-krEw=/1500x/smart/b829396acc244fd484c5ddcdcb2b08f3/ccmcms-commentcamarche/20494859.jpg');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>
    <p>Ceci est mon image</p>
    <div class="image"><img src="data:image/<?php echo $user->getPPformat() ?>;base64,<?php echo $user->getPP(); ?>" width="50px" height="50px"/></div>
</body>
</html>

<?php //$user->unsetPP() ?>