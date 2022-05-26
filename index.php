<?php

// important pour la sécurité de vos scripts : les sessions
// démarre une session
if(!isset($_SESSION)){
session_start();
}


// autoload.php généré avec composer
require_once __DIR__ . '/vendor/autoload.php';
require 'app/Sanitizer/UserSanitizer.php';
require 'app/Sanitizer/ContactSanitizer.php';

try {

    $frontController = new \Projet\Controllers\FrontController(); // objet Froncontroller
    $controller = new \Projet\Controllers\Controller();
    
    if (isset($_GET['action'])) {

        //redirection vers les différentes page du site web

        if ($_GET['action'] == '404'){
            return $controller->viewFront('404');
        }
        elseif ($_GET['action'] == 'errorLoading') {
            return $controller->viewFront('errorLoading');
        } 
        elseif ($_GET['action'] == 'bandPage') {
            $frontController->bandFront();
        } 

        elseif ($_GET['action'] == 'newsPage') {

            //permet de récupérer la page pour gérer la pagination
            if(isset($_GET['page']) && !empty($_GET['page'])){
                $currentPage = $_GET['page'];
            }else{
                $currentPage = 1;
            }
            $frontController->newsFront($currentPage);
        } 

        elseif ($_GET['action'] == 'concertsPage') {
            $frontController->concertsFront();
        }

        elseif ($_GET['action'] == 'rgpd') {
            $frontController->rgpd();
        }  
        
        elseif ($_GET['action'] == 'contactPage') {
            $frontController->contactFront($error = "");
        } 
        elseif ($_GET['action'] == 'loginPage') {
            $frontController->loginFront($error = "");
        }
        elseif ($_GET['action'] == 'userPage') {

            //si admin, acces au backoffice sinon page utilisateur
            if ($_SESSION['role'] == 1){
            header('Location: indexAdmin.php');
            }
            else{
                $frontController->userPage($error = "");
            }
        }
        
        //action de changement de mot de passe
        elseif ($_GET['action'] == 'changePwd') {
            
            /*récupération des variables du formulaire de connexion*/
           $mail = htmlspecialchars($_POST['mail']);
           $pass = htmlspecialchars($_POST['pwd']);
           $newPass = htmlspecialchars($_POST['newPwd']);
   
           // champs obligatoires
           if (!empty($mail) &&(!empty($pass)) && (!empty($newPass))){
               
                //envois les données au controller
               $frontController->changePwd($mail, $pass, $newPass);   
           }else{
               $error = "Vous devez remplir tous les champs.";
               $frontController->userPage($error);
           }
       }

        elseif ($_GET['action'] == 'login') {
             /*récupération des variables du formulaire de connexion*/
            $mail = htmlspecialchars($_POST['mail']);
            $pass = htmlspecialchars($_POST['pwd']);
    
            if (!empty($mail) &&(!empty($pass))){
                $frontController->login($mail, $pass);   
            }else{
                $error = "Vous devez remplir tous les champs.";
                $frontController->loginFront($error);
            }
        }

        //action page de création d'un nouveau compte utilisateur
        elseif ($_GET['action'] == 'newAccount') {
            $frontController->newAccount($error = "");
        } 

        // Action de création du nouvel utilisateur
        elseif ($_GET['action'] == 'createAccount') {
            /*récupération des variables du formulaire création de compte et envoie dans le sanitizer des données user*/
            $sanitizedData = new UserSanitizer($_POST);
            // fonction sanitizer pour sécuriser contre les injections
            $userData = $sanitizedData->call();
            /* test si les champs sont tous remplis */
            if (!empty($userData['lastname']) && (!empty($userData['firstname']) && (!empty($userData['mail']) &&(!empty($userData['password']))))){
                $frontController->createAccount($userData);
            }else {
                $error = "Vous devez remplir tous les champs.";
                $frontController->newAccount($error);
            }
        }

        //déconnexion et supression de la session
        elseif ($_GET['action'] == 'disconnect') {
            session_destroy();
            header('location: index.php');
        }

        //Page d'un article sélectionné 
        elseif ($_GET['action'] == 'singleNews'){
            $data = [
                'article_id' => htmlspecialchars($_GET['id']),
                'error' => ""
            ];
            $frontController->singleNews($data);
        }

        //action lorsqu'on envois un commentaire
        elseif ($_GET['action'] == 'postComment'){
            //récupère l'id du user et son commentaire et envois le tableau au controller
            $article_id = htmlspecialchars($_GET['id']);
            $comment = htmlspecialchars($_POST['comment']);
            $data = [
                'article_id' => $article_id,
                'user_id' => $_SESSION['id'],
                'comment' => $comment
            ];
            $frontController->postComment($data);
        }

        //suppresion d'un commentaire
        elseif ($_GET['action'] == 'deleteUserComment'){
            
            //récupère l'id du commentaire, du user et de l'article en envois le tout au controller
            $comment_id = htmlspecialchars($_GET['commentId']);
            $user_id = htmlspecialchars($_GET['idUser']);
            $article_id = htmlspecialchars($_GET['articleId']);

            $data = [
                'comment_id' => $comment_id,
                'idUser' => $user_id,
                'article_id' => $article_id,
            ];
            
            $frontController->deleteUserComment($data);
        }

        //Formulaire de contact
        elseif($_GET['action'] == 'contactForm'){

            /*récupération des variables du formulaire de contact et envoie dans le sanitizer de contact*/
            $sanitizedData = new ContactSanitizer($_POST);
            // fonction sanitizer pour sécuriser contre les injections
            $contactData = $sanitizedData->call();
            /* test si les champs obligatoires sont tous remplis */
            if (!empty($contactData['lastname']) && (!empty($contactData['firstname']) && (!empty($contactData['mail']) &&(!empty($contactData['content']))&&(!empty($_POST['rgpd']))))){
                $frontController->contactForm($contactData);
            }elseif(empty($_POST['rgpd'])){
                $error = "Vous devez lire et accepter les conditions générales.";
                $frontController->contactFront($error);
            }else {
                $error = "Vous devez remplir tous les champs obligatoires.";  
                $frontController->contactFront($error);
            }
        // si l'action ne correspond pas on renvois un code 404
        }else{
            throw new Exception("La page n'existe pas", 404);
        }
    } else {
        $frontController->home();
    }
} catch (Exception $e) {
    if ($e->getCode() == 404){
        header('Location: index.php?action=404');
    }
    header('Location: index.php?action=errorLoading');
}catch (Error $e) {
    header('Location: index.php?action=errorLoading');
}

