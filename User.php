<?php

if (session_status() == PHP_SESSION_NONE){ session_start();}

class User
{
    private ?int $id;
    public ?string $login;
    private $conn;

    public function __construct() {

        $db_username = 'root';
        $db_password = '';
        
        try{

            $this->conn = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', $db_username, $db_password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //echo "You are connected to the database <br>";
        }

        catch(PDOException $e){

            echo "Error : " . $e->getMessage();

        }

    }

    public function Register($login, $password, $passwordConfirm) {

        $messages = [];

        $sql = "SELECT * FROM utilisateurs WHERE login=:login";

        $req = $this->conn->prepare($sql);
        $req->execute(array(':login' => $login));
        $row = $req->rowCount();

        if($row <= 0 && strlen($login) >= 4 && !preg_match("[\W]", $login) && strlen($password) >= 5 && $password == $passwordConfirm) {
                
            $hash = password_hash($password, PASSWORD_DEFAULT);
                
            $sql = "INSERT INTO `utilisateurs` (`login`, `password`) VALUES (:login, :pass)";
            $req = $this->conn->prepare($sql);
            $req->execute(array(':login' => $login,
                                ':pass' => $hash
            ));

            $messages['okReg'] = 'Your account is now created and you can login';

        }else{

            if($row > 0) {

                $messages['errorLoginExist'] = 'The login already exist. Please choose another one';

            }

            if(strlen($login) <= 3 || preg_match("[\W]", $login)) {

                $messages['errorLogin'] = 'Your login must contain at least 4 caracters and no specials caracters';

            }

            if(strlen($password) <= 4) {

                $messages['errorPassLong'] = 'Your password must contain at least 5 caracters';

            }

            if($password != $passwordConfirm) {

                $messages['errorPassMatch'] = 'The passwords do not match';

            }
        }

        $json = json_encode($messages, JSON_PRETTY_PRINT);
        echo $json;

    }

    public function Connect($login, $password) {

        $messages = [];

        $sql = "SELECT * FROM utilisateurs WHERE login=:login";
        
        $req = $this->conn->prepare($sql);
        $req->execute(array(':login' => $login));
        $row = $req->rowCount();
        
        if($row == 1){

            $tab = $req->fetch(PDO::FETCH_ASSOC);
            $dataPass = $tab['password'];
            $id = $tab['id'];

            if(password_verify($password,$dataPass)){

                $_SESSION['id'] = $id;
                $_SESSION['login'] = $login;
                $_SESSION['password'] = $dataPass;

                $messages['okConn'] = 'You\'re connected';

            }else{
                $messages['errorPass'] = 'Wrong password';
            }
            
        }else{
            $messages['errorLogin'] = 'The login do not exist. If you don\'t have an account, please signup.';
        }

        $json = json_encode($messages, JSON_PRETTY_PRINT);
        echo $json;

    }

    public function Update($login, $password, $passwordNew, $passwordNewConfirm) {

        $messages = [];

        $sessionId = $_SESSION['id'];
        $passwordTrue = $_SESSION['password'];

        $sql = "SELECT * FROM utilisateurs WHERE id = :sessionId";
        $req = $this->conn->prepare($sql);
        $req->execute(array(':sessionId' => $sessionId));

        if(password_verify($password,$passwordTrue)){

            if ($_SESSION['login'] != $login && strlen($login) >= 4 && !preg_match("[\W]", $login)){

                $row = $req->rowCount();

                if($row <= 0){

                    $sqlLog = "UPDATE utilisateurs SET login = :login WHERE id = :sessionId";
            
                    $req = $this->conn->prepare($sqlLog);
                    $req->execute(array(':login' => $login, ':sessionId' => $sessionId));
                    
                    $_SESSION['login'] = $login;

                    $messages['okLoginEdit'] = 'Your login has been edited';

                }else{

                    $messages['errorLoginExist'] = 'The login already exist';

                }

            }elseif(strlen($login) < 4 || preg_match("[\W]", $login)) {

                $messages['errorLogin'] = "Your login must contain at least 4 caracters and no specials caracters";

            }

            

            if (!empty($passwordNew) && !empty($passwordNewConfirm && $passwordNew == $passwordNewConfirm && strlen($passwordNew) >= 5)){

                $hash = password_hash($passwordNew, PASSWORD_DEFAULT);

                $sqlPass = "UPDATE utilisateurs SET password = '$hash' WHERE id = '$sessionId'";
                $rs = $this->conn->query($sqlPass);

                $_SESSION['password'] = $hash;
            
                $messages['okPassEdit'] = 'Your password has been edited';

            }elseif(strlen($passwordNew) < 5 and !empty($passwordNew)) {

                $messages['errorPassLong'] = 'Your password must contain at least 5 caracters';

            }elseif (!empty($passwordNew) && empty($passwordNewConfirm)){
    
                $$messges['errorPassConfirm'] = 'Please confirm password';
    
            }elseif(($passwordNew != $passwordNewConfirm)) {

                $messages['errorPassDiff'] = 'The passwords are differents';

            }

        }else{ $messages['errorPassWrong'] = 'Wrong password'; }

        $json = json_encode($messages, JSON_PRETTY_PRINT);
        echo $json;

    }

    public function Disconnect() {

        session_destroy();
        exit('Vous avez bien été deconnecté');

    }

    public function Delete() {

        $messages = [];

        if($_SESSION){

            // Set variables to use in the following request.
            $sessionId = $_SESSION['id'];

            $sql = "DELETE FROM `utilisateurs` WHERE id = :sessionId";
        
            // Check if the username is already present or not in our Database.
            $req = $this->conn->prepare($sql);
            $req->execute(array(':sessionId' => $sessionId));

            session_destroy();
            exit('You have deleted your account');

        }else{
            $messages['errorDelete'] = 'You have to be connected to delete your account';
        }
        
        $json = json_encode($messages, JSON_PRETTY_PRINT);
        echo $json;
    }

    public function IsConnected() {

        if($_SESSION){
            return true;
        }else{
            return false;
        }

    }

    public function GetAllInfos() {

        if($_SESSION){
            return $_SESSION;
        }else{
            echo 'Please login to view your infos';
        }

    }

    public function GetLogin() {

        if($_SESSION){
            return $_SESSION['login'];
        }else{
            echo 'Please login to view your login';
        }

    }

}

?>