<?php

class ContactSanitizer{
    private $data = [ ];

    public function __construct($data)
    {
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->mail = $data['mail'];
        $this->phone = $data['phone'];
        $this->subject = $data['subject'];
        $this->content = $data['content'];
        

    }

  
    
    public function call(){
        $data = [
            'firstname' => htmlspecialchars($this->firstname),
            'lastname' => htmlspecialchars($this->lastname),
            'mail' => htmlspecialchars($this->mail),
            'phone' => htmlspecialchars($this->phone),
            'subject' => htmlspecialchars($this->subject),
            'content' => htmlspecialchars($this->content),
           
        ];
        
        return $data;
        
    }
}