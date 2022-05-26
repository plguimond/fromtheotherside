<?php

namespace Projet\Models;

//class Calendar sur le modèle de la table calendar en bdd

class Calendar extends Manager
{
    //fonction pour ajouter un nouveau concert
    public static function addConcert($data){
        $bdd = self::dbConnect();
        $sqlQuery = $bdd->prepare("INSERT INTO calendar(title, `date`, `location`, price) VALUE (:title, :date, :location, :price)");
        $sqlQuery->execute(array(':title' => $data['title'], ':date' => $data['date'], ':location' => $data['location'], ':price' => $data['price']));
    }

    //permet de connaitre le nombre de concert à venir à partir de maintenant
    public static function countNextShow(){
        $bdd = self::dbConnect();
        $req = $bdd->query('SELECT COUNT(id) AS number_of FROM calendar WHERE `date` >= CURRENT_TIMESTAMP');
        $result = $req->fetch();
        return $result;
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

   // récupère le prochain concert le plus proche de maintenant
    public function nextShow()
    {
        $bdd = self::dbConnect();
        $req = $bdd->query('SELECT id, title, `date`, `location`, price FROM calendar WHERE `date` >= CURRENT_TIMESTAMP order by `date` limit 1');
        $result = $req->fetch();
        return $result;
    } 

    //récupère tous les concerts à venir à partir de maintenant
    public function concerts()
    {
        $bdd = self::dbConnect();
        $req = $bdd->query('SELECT id, title, `date`, `location`, price FROM calendar WHERE `date` >= CURRENT_TIMESTAMP order by `date`');
        $result = $req->fetchAll();
        return $result;
    }

    //récupère tous les concerts
    public function allConcerts(){
        $bdd = self::dbConnect();
        $req = $bdd->query('SELECT id, title, `date`, `location`, price FROM calendar order by `date`');
        $result = $req->fetchAll();
        return $result;
    }

    //mise à jour des concerts
    public function updateConcert($data)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE calendar SET title = ?, `date` = ?, location = ?, price = ? WHERE id = ?');
        $req->execute(array($data['title'], $data['date'], $data['location'], $data['price'], $data['id']));
    }
}