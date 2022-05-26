<?php


namespace Projet\Models;


//class articles sur le modèle de la table article en bdd
class Articles extends Manager
{
    public $id;
    public $title;
    public $content;
    public $picture1;
    public $created_At;
    
    public function __construct($data = [])
    {
        $this->id = $data["id"] ?? '';
        $this->title = $data["title"] ?? '';
        $this->content = $data["content"] ?? '';
        $this->picture1 = $data["picture1"] ?? '';
        $this->created_At = $data["created_At"] ?? '';
    }

    //récupère la photo de l'article selon un id
    public function getNewsPicture($picture, $id)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare("SELECT `{$picture}` FROM articles WHERE id = ?");
        $req->execute(array($id));
        $result = $req->fetch();
        return $result;
    }

    // récupère uniquement l'article le plus récent
    public function lastNews()
    {
        $bdd = self::dbConnect();
        $req = $bdd->query('SELECT id, title, content, picture1 FROM articles ORDER BY created_At DESC LIMIT 1');
        $result = $req->fetch();
        return $result;
    }

    // récupère les news selon la pagination 
    public function newsList($firstNews, $perPage){
        
        $bdd = self::dbConnect();
        $req = $bdd->prepare('SELECT id, title, content, picture1, created_At FROM articles ORDER BY created_At DESC LIMIT :firstNews, :perPage');
        // Permet de préciser que les paramètres de la requête préparée sont des INT
        $req->bindValue(':firstNews', $firstNews, $bdd::PARAM_INT);
        $req->bindValue(':perPage', $perPage, $bdd::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll();
        
        return $result;
    }

    //création d'un nouvel article en bdd
    public function createNews($post, $picturesPath){
       
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO articles (title, content, picture1) VALUES (:title, :content, :picture1)');
        $req->execute(array(':title' => $post['title'], ':content' => $post['content'], ':picture1' => $picturesPath));
    }

    //Mise à jour d'un nouvel article en bdd
    public function updateNews($data, $picturesPath){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE articles SET title = :title, content = :content, picture1 = :picture1 WHERE id = :id');
        $req->execute(array(':title' => $data['title'], ':content' => $data['content'], ':picture1' => $picturesPath, ':id' => $data['id']));
    }
    //suppression d'un article en bdd selon l'id reçu
    public function deletePicture($picture, $id){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare("UPDATE articles SET `{$picture}` = null  WHERE id = ?");
        $req->execute(array($id));
    }
}