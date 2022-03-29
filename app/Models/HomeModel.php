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
}
