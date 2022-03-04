<?php
namespace Projet\Models;

class AdminModel extends Manager
{

    public function getSlides(){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, slide, title FROM slider');
        $req->execute();
        return $req;
    }
    public function updateSlider($slidePath){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE slider SET slide = ?');
        $req->execute(array($slidePath));
    }

}