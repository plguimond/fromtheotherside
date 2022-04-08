<?php

namespace Projet\Models;

class Slider extends Manager
{
    
    public $id;
    public $slide;
    public $title;
    
    
    public function __construct($data = [])
    {
        $this->id = $data["id"] ?? "";
        $this->lastname = $data["slide"] ?? "";
        $this->firstname = $data["title"] ?? "";
      
    }

      /* function du Model pour la partie Slider de la page d'accueuil */
    public function getSlidepath($id)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT slide FROM slider WHERE id = ?');
        $req->execute(array($id));
        $result = $req->fetch();
        return $result;
    }

    public function getSlides()
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, slide, title FROM slider');
        $req->execute();
        return $req;
    }
    
    public function updateSlider($sliders, $slidePath)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE slider SET slide = ?, title = ? WHERE id = ?');
        $req->execute(array($slidePath, $sliders['title'], $sliders['id']));
    }
    public function addSlide($slidePath, $title)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO slider (slide, title) VALUES (?, ?)');
        $req->execute(array($slidePath, $title));
    }
    public function deleteSlide($id)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM slider WHERE id = ?');
        $req->execute(array($id));
    }
}