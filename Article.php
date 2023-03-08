<?php

if (session_status() == PHP_SESSION_NONE){ session_start();}

class Article
{

    private ?int $id;
    private ?int $id_utilisateur;
    private ?string $contenu;
    private ?string $titre;
    private $date_creation;
    private $date_modification;
    private ?int $id_categorie;
    private ?PDO $conn;
    
    
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


    public function checkArticle(?string $contenu, ?string $titre, ?string $categorie) {

        $messages = [];
        $okTitre = $okContent = $okCategorie = false;
        $dateCrea = date('Y-m-d H:i:s');
        $this->setDateCrea($dateCrea);
        $this->setIdUser($_SESSION['user']['id']);

        $checkTitre = $this->verifTitre($titre);
        $checkContent = $this->verifContent($contenu);
        $checkCategorie = $this->verifCategorie($categorie);

        if($checkTitre === 'ok titre') {

            $this->setTitle($titre);

            $messages['successTitre'] = 'ok';

            $okTitre = true;

        }else{

            $messages['errorTitre'] = $checkTitre;

        }

        if($checkContent === 'ok contenu') {

            $this->setContent($contenu);

            $messages['successContent'] = 'ok';

            $okContent = true;

        }else{

            $messages['errorContent'] = $checkContent;

        }

        if($checkCategorie === 'ok categorie') {

            $sql = "SELECT * FROM categories WHERE nom = :nomCategorie";
            $req = $this->conn->prepare($sql);
            $req->execute(array(':nomCategorie' => $categorie));
            $tab = $req->fetch(PDO::FETCH_ASSOC);

            $categorieId = $tab['id'];

            $this->setCategorieId($categorieId);

            $messages['successCategorie'] = 'ok';

            $okCategorie = true;

        }else{

            $messages['errorCategorie'] = $checkCategorie;

        }

        if($okTitre === true && $okContent === true && $okCategorie === true) {

            $sql = "INSERT INTO articles (id_utilisateur, contenu, titre, date_creation, id_categorie) VALUES (:id_utilisateur, :contenu, :titre, :date_creation, :id_categorie)";
            $req = $this->conn->prepare($sql);
            $req->execute(array(':id_utilisateur' => $this->id_utilisateur,
                                ':contenu' => $this->contenu,
                                ':titre' => $this->titre,
                                ':date_creation' => $this->date_creation,
                                ':id_categorie' => $this->id_categorie
            ));

        }

        $json = json_encode($messages, JSON_PRETTY_PRINT);
        echo $json;

    }


    //*************** VERIFICATIONS ***************//

    private function verifTitre(?string $title) {

        if(isset($titre)) {

            if(strlen($title) > 5) {

                return 'ok titre';

            }else{ return 'The title is too short. It must be over 5 characters long'; }

        }else{ return 'You have to add a title to your article'; }

    }

    private function verifContent(?string $content) {

        if(isset($content)) {

            if(strlen($content) > 50) {

                return 'ok contenu';

            }else{ return 'Your article is too short. it must be over 50 cheracters long'; }

        }else{ return 'You have to add content to your article'; }

    }

    private function verifCategorie(?string $categorie) {

        if($categorie != '--Categorie--') {

            return 'ok categorie';

        }else{ return 'You must choose a category for your article'; }

    }


    //****************** SETTERS ******************//

    private function setIdUser(?int $id) {
        $this->id_utilisateur = $id;
    }

    private function setContent(?string $content) {
        $this->contenu = $content;
    }

    private function setTitle(?string $title) {
        $this->titre = $title;
    }

    private function setDateCrea($date) {
        $this->date_creation = $date;
    }

    private function setDateModif($date) {
        $this->date_modification = $date;
    }

    private function setCategorieId(?int $id) {
        $this->id_categorie = $id;
    }


    //****************** GETTERS ******************//

    public function getIdUser() {
        return $this->id_utilisateur;
    }

    public function getContent() {
        return $this->contenu;
    }

    public function getTitle() {
        return $this->titre;
    }

    public function getDateCrea() {
        return $this->date_creation;
    }

    public function getDateModif() {
        return $this->date_modification;
    }

    public function getCategorieId() {
        return $this->id_categorie;
    }

}

$article = new Article();

?>