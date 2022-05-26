<?php

namespace Projet\Models;
//class Contacts sur le modèle de la table contact en bdd
class Contacts extends Manager
{
    //récupère tous les messages enregistrés en bdd
    public static function contactMessage($contactData){
        $bdd = self::dbConnect();
        $sqlQuery = $bdd->prepare("INSERT INTO `contacts`(lastname, firstname, mail, phone, subject, content) VALUE (:lastname, :firstname, :mail, :phone, :subject, :content )");
        $sqlQuery->execute(array(':lastname' => $contactData['lastname'], ':firstname' => $contactData['firstname'], ':mail' => $contactData['mail'], ':phone' => $contactData['phone'],
        ':subject' => $contactData['subject'], ':content' => $contactData['content']));
        
    }
    
    public $id;
    public $lastname;
    public $firstname;
    public $mail;
    public $phone;
    public $subject;
    public $content;
    public $createdAt;
    
    public function __construct($data = [])
    {
        $this->id = $data["id"] ?? "";
        $this->firstname = $data['firstname'] ?? "";
        $this->lastname = $data['lastname'] ?? "";
        $this->mail = $data['mail'] ?? "";
        $this->phone = $data['phone'] ?? "";
        $this->subject = $data['subject'] ?? "";
        $this->content = $data['content'] ?? "";
        $this->createdAt = $data['createdAt'] ?? "";
    }

    
}