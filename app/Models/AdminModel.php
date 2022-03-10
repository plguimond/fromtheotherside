<?php

namespace Projet\Models;

class AdminModel extends Manager
{
    /* function du Model pour la partie Slider de la page d'accueuil */
    public function getSlides()
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, slide, title FROM slider');
        $req->execute();
        return $req;
    }
    public function getPwd($mail)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, lastname, firstname, mail, `role`, `password` FROM users WHERE mail = ?');
        $req->execute(array($mail));
        return $req;
    }

    public function updateSlider($sliders)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE slider SET slide = ?, title = ? WHERE id = ?');
        $req->execute(array($sliders['slidePath'], $sliders['title'], $sliders['id']));
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
