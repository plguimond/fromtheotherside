<?php

namespace Projet\Models;

class Calendar extends Manager
{
    public $id;
    public $title;
    public $date;
    public $location;
    public $price;
    
    public function __construct($data = [])
    {
        $this->id = $data["id"] ?? '';
        $this->title = $data["title"] ?? '';
        $this->content = $data["date"] ?? '';
        $this->location = $data["location"] ?? '';
        $this->price = $data["price"] ?? '';
  
    }


    public function nextShow()
    {
        $bdd = self::dbConnect();
        $req = $bdd->query('SELECT id, title, `date`, `location`, price FROM calendar WHERE `date` >= CURRENT_TIMESTAMP order by `date` limit 1');
        $result = $req->fetch();
        return $result;
    } 

    public function concerts()
    {
        $bdd = self::dbConnect();
        $req = $bdd->query('SELECT id, title, `date`, `location`, price FROM calendar WHERE `date` >= CURRENT_TIMESTAMP order by `date`');
        $result = $req->fetchAll();
        return $result;
    }
}