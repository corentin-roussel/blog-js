<?php

class Comment
{
    private ?int $id;

    private ?int $id_utilisateur;

    private ?string $contenu;

    private ?string $date_creation;

    private ?string $date_modification;

    private ?int $id_article;

    public ?PDO $conn;

    public function __construct()
    {
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

    //*************** COMMENTAIRES ***************//

    public function insertComment(?string $contenu) {

        $get = $_GET['article'];
        $getInt = (int)$get;
        $messages = [];
        $okComment = false;
        $dateCrea = date('Y-m-d H:i:s');
        $this->setDateCrea($dateCrea);
        $this->setDateModif($dateCrea);
        $this->setIdUser($_SESSION['user']['id']);
        $this->setIdArticle($getInt);


        $checkComment = $this->checkComment($contenu);



        if($checkComment == "ok comment")
        {

            $this->setContenu($contenu);

            $messages['successComment'] = 'ok';

            $okComment = true;
        }else {
            $messages['errorComment'] = $checkComment;
        }

        if($okComment === true)
        {
            $req = $this->conn->prepare("INSERT INTO `commentaires`(id_utilisateur, contenu, date_creation, date_modification, id_article) VALUES (:id_utilisateur,:contenu,:date_creation,:date_modification,:id_article)");
            $req->execute(array(
                ":id_utilisateur" => $this->id_utilisateur,
                ":contenu" => $this->contenu,
                ":date_creation" => $this->date_creation,
                ":date_modification" => $this->date_modification,
                ":id_article" => $this->id_article
            ));
            $messages['success'] = "Comment is posted";
        }

        $json = json_encode($messages, JSON_PRETTY_PRINT);
        echo $json;

        die();
    }

    public function getCommentaires() {
        $req = $this->conn->prepare("SELECT *, commentaires.id FROM commentaires INNER JOIN utilisateurs ON utilisateurs.id = commentaires.id_utilisateur WHERE commentaires.id_article = :id_article");
         $req->execute([
            ":id_article" => $_GET['article']
        ]);
        $comm = $req->fetchAll(PDO::FETCH_ASSOC);

        $json = json_encode($comm, JSON_PRETTY_PRINT);

        echo $json;

        die();
    }


    //*************** VERIFICATION ***************//

    public function checkComment($commentaire)
    {
        if(!empty(trim($commentaire))) {

            if(grapheme_strlen($commentaire) < 1000)
            {
                return "ok comment";
            }else {
                return "The comment can contain only 1000 characters";
            }
        }else {
            return "Please enter something in the commentary section";
        }
    }

    //*************** SETTERS ***************//

    public function setId(?int $id): void
    {
        $this->id = $id;
    }


    public function setIdUser(?int $id_utilisateur): void
    {
        $this->id_utilisateur = $id_utilisateur;
    }

    public function setContenu(?string $contenu): void
    {
        $this->contenu = $contenu;
    }

    public function setDateCrea(?string $date_creation): void
    {
        $this->date_creation = $date_creation;
    }

    public function setDateModif(?string $date_modification)
    {
        $this->date_modification = $date_modification;
    }

    public function setIdArticle(?int $id_article)
    {
        $this->id_article = $id_article;
    }
    //*************** GETTERS ***************//


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function getDateCreation()
    {
        return $this->date_creation;
    }

    public function getDateModif()
    {
        return $this->date_modification;
    }

    public function getIdArticle()
    {
        return $this->id_article;
    }
}