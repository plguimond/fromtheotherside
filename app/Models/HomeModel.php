<?php

namespace Projet\Models;

class HomeModel extends Manager
{
    public function getUser()
    {
        $bdd = self::dbConnect();
        $req = $bdd->query('SELECT * FROM users');
        return $req;
    }


    //    public function postMail($lastname, $firstname, $mail, $phone, $objet, $content){
    //        $bdd = $this->dbConnect();
    //        $req = $bdd->prepare('INSERT INTO contacts(lastname, firstname, mail, phone, objet, content) VALUE (?, ?, ?, ?, ?, ?)');
    //        $req->execute(array($lastname, $firstname, $mail, $phone, $objet, $content));
    //        return $req;
    //    }

    //    public function countMail(){
    //     $bdd = $this->dbConnect();
    //     $req = $bdd->query('SELECT COUNT(id) FROM contacts');
    //     return $req;
    //    }

    //    public function deleteMail($id){
    //     $bdd = $this->dbConnect();
    //     $req = $bdd->prepare('DELETE FROM `contacts` WHERE id = ?');
    //     $req->execute((array($id)));
    //    }

    //    public function viewMail($id){
    //     $bdd = $this->dbConnect();
    //     $req = $bdd->prepare('SELECT * FROM `contacts` WHERE id = ?');
    //     $req->execute((array($id)));
    //     return $req;
    //    }

}
