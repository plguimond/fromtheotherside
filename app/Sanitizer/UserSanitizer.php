<?php
//sanitizer pour filtrer les valeurs du formulaire de cration de compte

class UserSanitizer{
    private $data = [ ];

    public function __construct($data)
    {
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->mail = $data['mail'];
        $this->pwd = $data['pwd'];
    }

  
    
    public function call(){
        $data = [
            'firstname' => htmlspecialchars($this->firstname),
            'lastname' => htmlspecialchars($this->lastname),
            'mail' => htmlspecialchars($this->mail),
            'password' => htmlspecialchars($this->pwd)
        ];
        
        return $data;
        
    }
}