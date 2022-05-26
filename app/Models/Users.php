<?php

namespace Projet\Models;

//class Users sur le modèle de la table users en bdd
class Users extends Manager
{

    //création d'un nouvel utilisateur
    public static function createUser($userData){
        //crypte le mot de passe
        $password = password_hash($userData['password'], PASSWORD_DEFAULT);
        $bdd = self::dbConnect();
        $sqlQuery = $bdd->prepare("INSERT INTO `users`(lastname, firstname, mail, `password`) VALUE (:lastname, :firstname, :mail, :password )");
        $sqlQuery->execute(array(':lastname' => $userData['lastname'], ':firstname' => $userData['firstname'], ':mail' => $userData['mail'], ':password' => $password));
        
    }
    
    public $id;
    public $lastname;
    public $firstname;
    public $mail;
    
    public function __construct($data = [])
    {
        $this->id = $data["id"] ?? "";
        $this->lastname = $data["lastname"] ?? "";
        $this->firstname = $data["firstname"] ?? "";
        $this->mail = $data["mail"] ?? "";
    }

    //permet de mofifier le mot de passe de l'utilisateur
    public function changePwd($mail, $newPwd){
        $password = password_hash($newPwd, PASSWORD_DEFAULT);
        $bdd = self::dbConnect();
        $sqlQuery = $bdd->prepare("UPDATE `users` SET `password` = :password WHERE mail = :mail");
        $sqlQuery->execute(array(':password' => $password, ':mail' => $mail));
    }
    
}