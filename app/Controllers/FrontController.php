<?php

namespace Projet\Controllers;


class FrontController extends Controller
{

    public function home()
    {
        $members = \Projet\Models\Bandmembers::all();
        $articles  = new \Projet\Models\articles();
        $concerts  = new \Projet\Models\Calendar();

        $nextShow = $concerts->nextShow();
        $lastNews = $articles->lastNews();
        $data = [
            'members' => $members,
            'lastNews' => $lastNews,
            'nextShow' => $nextShow
        ];
        return $this->viewFront('home', $data);
      
    }
    public function bandFront()
    {
        return $this->viewFront('band');
       
    }
    public function newsFront($currentPage)
    {
        // $news = \Projet\Models\Articles::all();
        $articles = new \Projet\Models\articles();
        // Nb d'articles
        $newsCount = \Projet\Models\Articles::count();
        // nb d'articles par page
        $perPage = 10;
        // nb de pages total
        $pages = ceil($newsCount['number_of'] / $perPage);
        // premier article de la page
        $firstNews = ($currentPage * $perPage) - $perPage;
        $news = $articles->newslist($firstNews, $perPage);
       
        $data = [
            'articles' => $news,
            'newsCount' => $newsCount['number_of'],
            'currentPage' => $currentPage
        ];

        return $this->viewFront('news', $data);
    }
    public function concertsFront()
    {
        return $this->viewFront('concerts');
    }
    public function contactFront($error)
    {
        $data = [
            'error' => $error
        ];
        return $this->viewFront('contact', $data);
    }
    public function loginFront($error)
    {
        $data = [
            'error' => $error
        ];
        return $this->viewFront('login', $data);
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
                $data = [
                    'error' => $error
                ];
                return $this->viewFront('login', $data);
            }
        } else {
            $error = "Vous n'êtes pas encore enregistré, veuillez créer un compte.";
            $data = [
                'error' => $error
            ];
            return $this->viewFront('login', $error);
        }
    }

    public function newAccount($error)
    {
        $data = [
            'error' => $error
        ];
    
        return $this->viewFront('createAccount', $data);
    }

    public function createAccount($userData)
    {
        $exist = \Projet\Models\Users::exist('mail', $userData['mail']);

        if(!filter_var($userData['mail'], FILTER_VALIDATE_EMAIL)){
            $data = [
                'error' => "L'adresse email n'est pas valide!"
            ];
            return $this->viewFront('createAccount', $data);
        }
        if ($exist != true) {
            $user = \Projet\Models\Users::createUser($userData);
        } else {
            $error = "Cet utilisateur existe déjà";
            $data = [
                'error' => $error
            ];
            return $this->viewFront('createAccount', $data);
        }
        return $this->viewFront('login');
    }

    public function singleNews($id)
    {
        $lastNews = \Projet\Models\Articles::find('id', $id);
        $data = [
            'singleNews' => $lastNews
        ];
        return $this->viewFront('singleNews', $data);
    }

    public function contactForm($contactData){
        
        if(!filter_var($contactData['mail'], FILTER_VALIDATE_EMAIL)){
            $data = [
                'error' => "L'adresse email n'est pas valide!"
            ];
            return $this->viewFront('contact', $data);
        }else{
            $contactMessage = \Projet\Models\Contacts::contactmessage($contactData);
            $data = [
                'message' => "Votre message à bien été envoyé."
            ];
            return $this->viewFront('contact', $data);
        }
    }
}
