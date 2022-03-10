<?php

namespace Projet\Models;

class Users extends Manager
{
    public $id;
    public $lastname;
    public $firstname;
    public $mail;
    public $password;
    
    public function __construct($data)
    {
        $this->id = $data["id"];
        $this->lastname = $data["lastname"];
        $this->firstname = $data["firstname"];
        $this->password = $data["password"];
    }
}