<?php

namespace Projet\Models;

class Articles extends Manager
{
    public $id;
    public $title;
    public $content;
    public $picture1;
    public $picture2;
    public $picture3;
    
    public function __construct($data = [])
    {
        $this->id = $data["id"] ?? '';
        $this->title = $data["title"] ?? '';
        $this->content = $data["content"] ?? '';
        $this->picture1 = $data["picture1"] ?? '';
        $this->picture2 = $data["picture2"] ?? '';
        $this->picture3 = $data["picture3"] ?? '';
    }


    public function lastNews()
    {
        $bdd = self::dbConnect();
        $req = $bdd->query('SELECT id, title, content, picture1 FROM articles order by created_At DESC limit 1');
        $result = $req->fetch();
        return $result;
    }
}