<?php

namespace Projet\Models;
//class Slider sur le modèle de la table slider en bdd
class Slider extends Manager
{
    
    public $id;
    public $slide;
    public $title;
    
    
    public function __construct($data = [])
    {
        $this->id = $data["id"] ?? "";
        $this->slide = $data["slide"] ?? "";
        $this->title = $data["title"] ?? "";
      
    }

      /* function du Model pour la partie Slider de la page d'accueil */

      //récupère  l'url de l'image en bdd
    public function getSlidepath($id)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT slide FROM slider WHERE id = ?');
        $req->execute(array($id));
        $result = $req->fetch();
        return $result;
    }

    //récupère tous les slides du slider
    public function getSlides()
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, slide, title FROM slider');
        $req->execute();
        return $req;
    }
    

    //Mise à jour en bdd d'une slide
    public function updateSlider($sliders, $slidePath)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE slider SET slide = ?, title = ? WHERE id = ?');
        $req->execute(array($slidePath, $sliders['title'], $sliders['id']));
    }

    // Ajout d'une nouvelle slide
    public function addSlide($slidePath, $title)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO slider (slide, title) VALUES (?, ?)');
        $req->execute(array($slidePath, $title));
    }

    //suppression d'une slide
    public function deleteSlide($id)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM slider WHERE id = ?');
        $req->execute(array($id));
    }
}