<?php

namespace Projet\Models;

class Users extends Manager
{
    public static function createUser($lastname, $firstname, $mail, $password){
        $bdd = self::dbConnect();
        $sqlQuery = $bdd->prepare("INSERT INTO `users`(lastname, firstname, mail, `password`) VALUE (:lastname, :firstname, :mail, :password )");
        $sqlQuery->execute(array(':lastname' => $lastname, ':firstname' => $firstname, ':mail' => $mail, ':password' => $password));
        
    }
    
    
    // public $WHITELIST_COLUMN = ['id', 'lastname','firstname','mail','password'];
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