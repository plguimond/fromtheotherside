<?php

namespace Projet\Models;

class Users extends Manager
{
    public static function createUser($userData){
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

    
}