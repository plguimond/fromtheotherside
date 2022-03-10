<?php

namespace Projet\Controllers;

class FrontController
{

    public function home()
    {   
        $members = \Projet\Models\Bandmembers::all();
        require 'app/Views/front/home.php';
    }
    public function bandFront()
    {
        require 'app/Views/front/band.php';
    }
    public function newsFront()
    {
        require 'app/Views/front/news.php';
    }
    public function concertsFront()
    {
        require 'app/Views/front/concerts.php';
    }
    public function contactFront()
    {
        require 'app/Views/front/contact.php';
    }
    public function loginFront()
    {
        require 'app/Views/front/login.php';
    }
    public function createAccount()
    {
        require 'app/Views/front/createAccount.php';
    }
}
