<?php

namespace Projet\Controllers;


class FrontController extends Controller
{

// Gestion de la page d'accueil
    public function home()
    {
        $members = \Projet\Models\Bandmembers::all();
        $articles  = new \Projet\Models\articles();
        $concerts  = new \Projet\Models\Calendar();
        $slider = \Projet\Models\Slider::all();

        $nextShow = $concerts->nextShow();
        // $nextShow['date'] = $this->formatDate($nextShow['date']);
        
        $lastNews = $articles->lastNews();
        $data = [
            'members' => $members,
            'lastNews' => $lastNews,
            'nextShow' => $nextShow,
            'slider' => $slider,
        ];
        return $this->viewFront('home', $data);
    }
// Lien vers la page du groupe

    public function bandFront()
    {
        $members = \Projet\Models\Bandmembers::all();

        return $this->viewFront('band', $members);
    }

// Gestion de la page des news
    public function newsFront($currentPage)
    {
        $articles = new \Projet\Models\articles();
        // Nb d'articles
        $newsCount = \Projet\Models\Articles::count();
        // nb d'articles par page
        $perPage = 6;
        // nb de pages total
        $pages = ceil($newsCount['number_of'] / $perPage);
        // premier article de la page
        $firstNews = ($currentPage * $perPage) - $perPage;
        $news = $articles->newslist($firstNews, $perPage);
     
        $data = [
            'articles' => $news,
            'newsCount' => $newsCount['number_of'],
            'currentPage' => $currentPage,
            'pages' => $pages
        ];
        return $this->viewFront('news', $data);
    }

// Gestion de la page des concerts
    public function concertsFront()
    {
        $concerts  = new \Projet\Models\Calendar();

        $nextConcerts = $concerts->concerts();

        $dataConcerts = [
            'concerts' => $nextConcerts,
        ];
        return $this->viewFront('concerts', $dataConcerts);
    }

// Gestion de la page du formuaire de contact
    public function contactFront($error)
    {
        $data = [
            'error' => $error
        ];
        return $this->viewFront('contact', $data);
    }

// Function pour enregistrer en bdd le message du formulaire de contact envoyé par un visiteur
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
            unset($_POST);
            return $this->viewFront('contact', $data);
        }
    }

// Gestion de la page Login
    public function loginFront($error)
    {
        $data = [
            'error' => $error
        ];
        return $this->viewFront('login', $data);
    }

//Gestion de la page perso de l'utilisateur
    public function userPage()
    {
        return $this->viewFront('userPage');
    }

/* function login pour établir la connexion au compte utilisateur*/
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

// Gestion de la page de creation de compte
    public function newAccount($error)
    {
        $data = [
            'error' => $error
        ];
    
        return $this->viewFront('createAccount', $data);
    }

// function de création en bdd du nouveau compte
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

// Gestion de la page d'affichage d'un article complet
    public function singleNews($data)
    {
        $singleNews = \Projet\Models\Articles::find('id', $data['article_id']);
        
        $comments = \Projet\Models\Comments::getUserComments($data['article_id']);
    
        $newsData = [
            'singleNews' => $singleNews,
            'error' => $data['error'],
            'comments' => $comments
        ];
        return $this->viewFront('singleNews', $newsData);
    }

 // Function pour enregistrer en bdd le commentaire d'un utilisateur   
    public function postComment($data){
        if (!empty($data['comment'])){
            $postComment = \Projet\Models\Comments::postComment($data);
            header('Location: index.php?action=singleNews&id='. $data['article_id']);  
        }else{
            $error = "Vous n'avez pas écrit votre commentaire";
            $errorData = [
                'article_id' => $data['article_id'],
                'error' => $error
            ];
            $this->singleNews($errorData);
        }

    }

    public function deleteUserComment($data){
      
        if ($_SESSION['id'] == $data['idUser']){
            
            $delete = \Projet\Models\Comments::delete('id', $data['comment_id']);
            header('Location: index.php?action=singleNews&id='. $data['article_id']);
        }
        else{
            header('Location: index.php');
        }
    }


}
