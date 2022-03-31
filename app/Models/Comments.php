<?php


namespace Projet\Models;



class Comments extends Manager
{

    public static function postComment($commentData){
        // var_dump($commentData);die;
        $bdd = self::dbConnect();
        $sqlQuery = $bdd->prepare("INSERT INTO `comments`(content, idUser,  idArticle) VALUE (:comment, :idUser, :idArticle)");
        $sqlQuery->execute(array(':comment' => $commentData['comment'], ':idUser' => $commentData['user_id'], ':idArticle' => $commentData['article_id']));
        
    }

    public static function getUserComments($articleId){
        
        $bdd = self::dbConnect();
        $sqlQuery = $bdd->prepare("SELECT content, comments.createdAt, firstname, lastname FROM comments INNER JOIN users ON users.id = comments.idUser WHERE comments.idArticle = :idArticle");
        $sqlQuery->execute(array(':idArticle' => $articleId));
        $result = $sqlQuery->fetchAll();
        
        return $result;
    }

    public $id;
    public $content;
    public $article_id;
    public $user_id;
    public $created_At;
    
    public function __construct($data = [])
    {
        $this->id = $data["id"] ?? '';
       
        $this->content = $data["content"] ?? '';
        $this->article_id = $data["article_id"] ?? '';
        $this->user_id = $data["user_id"] ?? '';
        $this->created_At = $data["created_At"] ?? '';
    }
  
}