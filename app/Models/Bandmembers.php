<?php

namespace Projet\Models;

class Bandmembers extends Manager
{
    public $id;
    public $lastname;
    public $firstname;
    public $type;
    public $excerpt;
    public $info;
    public $picture;
    

    public function __construct($data)
    {
        $this->id = $data["id"];
        $this->lastname = $data["lastname"];
        $this->firstname = $data["firstname"];
        $this->type = $data["type"];
        $this->excerpt = $data["excerpt"];
        $this->info = $data["info"];
        $this->picture = $data["picture"];
    }


    // public function getBand()
    // {
    //     $bdd = self::dbConnect();
    //     $req = $bdd->query('SELECT firstname, `type`, excerpt, picture FROM bandmembers');
    //     return $req;
    // }
}