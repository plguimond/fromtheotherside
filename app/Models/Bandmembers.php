<?php

namespace Projet\Models;
//class Bandmembers sur le modèle de la table bandmembers en bdd

class Bandmembers extends Manager
{
    public $id;
    public $lastname;
    public $firstname;
    public $type;
    public $excerpt;
    public $info;
    public $picture;
    

    public function __construct($data = [])
    {
        $this->id = $data["id"] ?? "";
        $this->lastname = $data["lastname"] ?? "";
        $this->firstname = $data["firstname"] ?? "";
        $this->type = $data["type"] ?? "";
        $this->excerpt = $data["excerpt"] ?? "";
        $this->info = $data["info"] ?? "";
        $this->picture = $data["picture"] ?? "";
    }


    //permet de récupérer une photo d'un membre 
    public function getPicturePath($id)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT picture FROM bandmembers WHERE id = ?');
        $req->execute(array($id));
        $result = $req->fetch();
        return $result;
    }

    //Mise à jour en bdd d'un membre
    public function updateMember($data, $memberPath){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE bandmembers SET lastname = :lastname, firstname = :firstname, type = :type, 
            excerpt = :excerpt, info = :info, picture = :picture WHERE id = :id');
        $req->execute(array(':lastname' => $data['lastname'], ':firstname' => $data['firstname'], ':type' => $data['type'],
            ':excerpt' => $data['excerpt'], ':info' => $data['info'], ':picture' => $memberPath, ':id' => $data['id']));
    }

    //ajout d'un nouveau membre en bdd
    public function addMember($data, $memberPath)
    {

        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO bandmembers (lastname, firstname, type, excerpt, info, picture) VALUES (:lastname, :firstname, :type, :excerpt, :info, :picture)');
        $req->execute(array(':lastname' => $data['lastname'], ':firstname' => $data['firstname'], ':type' => $data['type'],
        ':excerpt' => $data['excerpt'], ':info' => $data['info'], ':picture' => $memberPath));
    }
}