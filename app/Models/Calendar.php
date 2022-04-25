<?php

namespace Projet\Models;



class Calendar extends Manager
{
    public static function addConcert($data){
        $bdd = self::dbConnect();
        $sqlQuery = $bdd->prepare("INSERT INTO calendar(title, `date`, `location`, price) VALUE (:title, :date, :location, :price)");
        $sqlQuery->execute(array(':title' => $data['title'], ':date' => $data['date'], ':location' => $data['location'], ':price' => $data['price']));
        
    }

    public $id;
    public $title;
    public $date;
    public $location;
    public $price;
    
    public function __construct($data = [])
    {
        $this->id = $data["id"] ?? '';
        $this->title = $data["title"] ?? '';
        $this->date = $data["date"] ?? '';
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
    public function allConcerts(){
        $bdd = self::dbConnect();
        $req = $bdd->query('SELECT id, title, `date`, `location`, price FROM calendar order by `date`');
        $result = $req->fetchAll();
        return $result;
    }

    public function updateConcert($data)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE calendar SET title = ?, `date` = ?, location = ?, price = ? WHERE id = ?');
        $req->execute(array($data['title'], $data['date'], $data['location'], $data['price'], $data['id']));
    }
}