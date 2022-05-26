<?php

namespace Projet\Controllers;


class FrontController extends Controller
{

// Gestion de la page d'accueil
    public function home()
    {
        //récupère toutes les ressources pour la page d'accueil
        $members = \Projet\Models\Bandmembers::all();
        $articles  = new \Projet\Models\articles();
        $concerts  = new \Projet\Models\Calendar();
        $slider = \Projet\Models\Slider::all();
        $nextShow = $concerts->nextShow();
        $lastNews = $articles->lastNews();

        //créer un tableau data pour récupérer chaque objet sur la page d'accueil
        $data = [
            'members' => $members,
            'lastNews' => $lastNews,
            'nextShow' => $nextShow,
            'slider' => $slider,
        ];
        //redirection vers la page avec ses données
        return $this->viewFront('home', $data);
    }

// Lien vers la page du groupe
    public function bandFront()
    {
        $members = \Projet\Models\Bandmembers::all();

        return $this->viewFront('band', $members);
    }

// Lien vers la page rgpd
    public function rgpd()
    {
        $members = \Projet\Models\Bandmembers::all();
        return $this->viewFront('rgpd');
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

// Gestion de la page du formulaire de contact
    public function contactFront($error)
    {
        $data = [
            'error' => $error
        ];
        return $this->viewFront('contact', $data);
    }

// Function pour enregistrer en bdd le message du formulaire de contact envoyé par un visiteur
    public function contactForm($contactData){
        
        //vérifie si les conditions du formualaire sont remplies sinon renvois une erreur
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
    public function userPage($error)
    {
        $data = [
            'error' => $error
        ];
        return $this->viewFront('userPage', $data);
    }

/* function login pour établir la connexion au compte utilisateur*/
    public function login($mail, $pass)
    {

        //récupère et vérifie si le mail est dans la bdd
        $exist = \Projet\Models\Users::exist('mail', $mail);
        
        // si l'utilisateur existe
        if ($exist == true) {

            // on récupère ses informations 
            $user = \Projet\Models\Users::find('mail', $mail);

            // on vérifie le mot de passe et si c'est le bon on enregistre en session ses informations
            $isPasswordCorrect = password_verify($pass, $user['password']);
            if ($isPasswordCorrect){
                $_SESSION['mail'] = $user['mail'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['lastname'] = $user['lastname'];
                $_SESSION['role'] = $user['role'];
            }
            //si il son role est admin (1) redirection sur le dashboard du backoffice
            if ($isPasswordCorrect && $user['role'] == 1) {
                header('location: indexAdmin.php?action=dashboard');
            
            //si c'est un user classique, redirection sur la page d'accueil
            } elseif ($isPasswordCorrect && $user['role'] == 0) {
                $this->home();

            //sinon on vérifie ce qui ne va pas et renvois le bon message d'erreur
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

/* function changePwd pour modifier le mot de passe utilisateur*/
public function changePwd($mail, $pass, $newPass)
{
    // on vérifie que l'utilisateur existe et on récupère ses informations
    $exist = \Projet\Models\Users::exist('mail', $mail);
    if ($exist == true) {
        $user = \Projet\Models\Users::find('mail', $mail);

        //si me mot de passe correspond à celui en bdd, on procède à la modification du nouveau mdp
        $isPasswordCorrect = password_verify($pass, $user['password']);
        if ($isPasswordCorrect){
            $newPwd  = new \Projet\Models\Users();
            $newPassword = $newPwd->changePwd($mail, $newPass);
            $data = [
                'validation' => "Votre mot de passe à été modifié avec succès"
            ];
            return $this->viewFront('userPage', $data);
        
        //sinon on renvoie le messages d'erreur
        } else {
            $error = "Vérifiez que vous avez saisi le bon mot de passe.";
            $data = [
                'error' => $error
            ];
            return $this->viewFront('userPage', $data);
        }
    } else {
        $error = "Vérifier que vous avez saisi la bonne adresse e-mail.";
        $data = [
            'error' => $error
        ];
        return $this->viewFront('userPage', $data);
    }
}

// redirection sur la page de creation de compte
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
        //on récupère les informations du formulaire, on les vérifies et on créer un nouvel utilisateur ou renvois une erreur
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
        // on récupère l'article et ses commentaires
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

        // enregistre le commentaires et renvois sur la page de l'article commenté
        if (!empty($data['comment'])){
            $postComment = \Projet\Models\Comments::postComment($data);
            header('Location: index.php?action=singleNews&id='. $data['article_id']); 
            
        //si le formulaire est envoyé sans commentaires, on envoie un message d'erreur
        }else{
            $error = "Vous n'avez pas écrit votre commentaire";
            $errorData = [
                'article_id' => $data['article_id'],
                'error' => $error
            ];
            $this->singleNews($errorData);
        }
    }

    //fonction pour supprimer son commentaire
    public function deleteUserComment($data){
      
        // un user peut supprimer uniquement ses commentaires, l'admin peut supprimer tous les commentaires
        if ($_SESSION['id'] == $data['idUser'] || $_SESSION['role'] == 1 ){
            
            $delete = \Projet\Models\Comments::delete('id', $data['comment_id']);
            header('Location: index.php?action=singleNews&id='. $data['article_id']);
        }
        else{
            header('Location: index.php');
        }
    }


}
