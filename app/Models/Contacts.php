<?php

namespace Projet\Models;

class Contacts extends Manager
{
    public static function contactMessage($contactData){
        $bdd = self::dbConnect();
        $sqlQuery = $bdd->prepare("INSERT INTO `contacts`(lastname, firstname, mail, phone, subject, content) VALUE (:lastname, :firstname, :mail, :phone, :subject, :content )");
        $sqlQuery->execute(array(':lastname' => $contactData['lastname'], ':firstname' => $contactData['firstname'], ':mail' => $contactData['mail'], ':phone' => $contactData['phone'],
        ':subject' => $contactData['subject'], ':content' => $contactData['content']));
        
    }
    
    
    // public $WHITELIST_COLUMN = ['id', 'lastname','firstname','mail','password'];
    public $id;
    public $lastname;
    public $firstname;
    public $mail;
    public $phone;
    public $subject;
    public $content;
    
    public function __construct($data = [])
    {
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->mail = $data['mail'];
        $this->phone = $data['phone'];
        $this->subject = $data['subject'];
        $this->content = $data['content'];
    }

    
}