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
    public function loginFront($error)
    {
        require 'app/Views/front/login.php';
    }
    public function userPage()
    {
        require 'app/Views/front/userPage.php';
    }

     /* function login*/
    public function login($mail, $pass)
    {

        $exist = \Projet\Models\Users::exist('mail', $mail);
        if ($exist == true) {
            $user = \Projet\Models\Users::find('mail', $mail);

            $_SESSION['mail'] = $user['mail'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['role'] = $user['role'];

            $isPasswordCorrect = password_verify($pass, $user['password']);

            if ($isPasswordCorrect && $user['role'] == 1) {
                header('location: indexAdmin.php?action=dashboard');
            } elseif ($isPasswordCorrect && $user['role'] == 0) {
                $this->home();
            } else {
                $error = "Vérifiez que vous avez saisi le bon mot de passe.";
                require 'app/Views/front/login.php';
            }
        } else {
            $error = "Vous n'êtes pas encore enregistré, veuillez créer un compte.";
            require 'app/Views/front/login.php';
        }
    }
    public function newAccount($error)
    {
        require 'app/Views/front/createAccount.php';
    }
    public function createAccount($userData)
    {
        $exist = \Projet\Models\Users::exist('mail', $userData['mail']);
        if ($exist != true) {
            $user = \Projet\Models\Users::createUser($userData);
        } else {
            $error = "Cet utilisateur existe déjà";
            require 'app/Views/front/createAccount.php';
        }

        require 'app/Views/front/login.php';
    }
}
