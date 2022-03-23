<?php

namespace Projet\Controllers;

class FrontController extends Controller
{

    public function home()
    {
        $members = \Projet\Models\Bandmembers::all();
        return $this->viewFront('home', $members);
      
    }
    public function bandFront()
    {
        return $this->viewFront('band');
       
    }
    public function newsFront()
    {
        return $this->viewFront('news');
    }
    public function concertsFront()
    {
        return $this->viewFront('concerts');
    }
    public function contactFront()
    {
        return $this->viewFront('contact');
    }
    public function loginFront($error)
    {
        return $this->viewFront('login', $error);
    }
    public function userPage()
    {
        return $this->viewFront('userPage');
    }

     /* function login*/
    public function login($mail, $pass)
    {

        $exist = \Projet\Models\Users::exist('mail', $mail);
        if ($exist == true) {
            $user = \Projet\Models\Users::find('mail', $mail);

            

            $isPasswordCorrect = password_verify($pass, $user['password']);
            if ($isPasswordCorrect){
                $_SESSION['mail'] = $user['mail'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['lastname'] = $user['lastname'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['role'] = $user['role'];
            }
            if ($isPasswordCorrect && $user['role'] == 1) {
                header('location: indexAdmin.php?action=dashboard');
            } elseif ($isPasswordCorrect && $user['role'] == 0) {
                $this->home();
            } else {
                $error = "Vérifiez que vous avez saisi le bon mot de passe.";
                return $this->viewFront('login', $error);
            }
        } else {
            $error = "Vous n'êtes pas encore enregistré, veuillez créer un compte.";
            return $this->viewFront('login', $error);
        }
    }
    public function newAccount($error)
    {
        return $this->viewFront('createAccount');
    }
    public function createAccount($userData)
    {
        $exist = \Projet\Models\Users::exist('mail', $userData['mail']);
        if ($exist != true) {
            $user = \Projet\Models\Users::createUser($userData);
        } else {
            $error = "Cet utilisateur existe déjà";
            return $this->viewFront('createAccount', $error);
        }
        return $this->viewFront('login');
    }
}
