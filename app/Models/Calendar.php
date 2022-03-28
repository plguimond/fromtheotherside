<?php

namespace Projet\Models;

class Calendar extends Manager
{
    public $id;
    public $title;
    public $date;
    public $location;
    public $price;
    public $published;
    
    public function __construct($data = [])
    {
        $this->id = $data["id"] ?? '';
        $this->title = $data["title"] ?? '';
        $this->content = $data["date"] ?? '';
        $this->picture1 = $data["location"] ?? '';
        $this->picture2 = $data["price"] ?? '';
        $this->picture3 = $data["published"] ?? '';
    }


    public function nextShow()
    {
        $bdd = self::dbConnect();
        $req = $bdd->query('SELECT id, title, `date`, `location`, price FROM calendar WHERE published = 1 order by `date` limit 1');
        $result = $req->fetch();
        return $result;
    } 
}