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

    $frontController = new \Projet\Controllers\FrontController(); // objet controler

    if (isset($_GET['action'])) {

        if ($_GET['action'] == 'bandPage') {
            $frontController->bandFront();
        } 

        elseif ($_GET['action'] == 'newsPage') {
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
        
        elseif ($_GET['action'] == 'contactPage') {
            $frontController->contactFront($error = "");
        } 

        elseif ($_GET['action'] == 'loginPage') {
            $frontController->loginFront($error = "");
        }
        elseif ($_GET['action'] == 'userPage') {
            // $frontController->UserFront();
            if ($_SESSION['role'] == 1){
            header('Location: indexAdmin.php');
            }else{
                $frontController->userPage();
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
        elseif ($_GET['action'] == 'newAccount') {
            $frontController->newAccount($error = "");
        } 
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
        elseif ($_GET['action'] == 'singleNews'){
            $data = [
                'article_id' => htmlspecialchars($_GET['id']),
                'error' => ""
            ];
            $frontController->singleNews($data);
        }
        elseif ($_GET['action'] == 'postComment'){
            $article_id = htmlspecialchars($_GET['id']);
            $comment = htmlspecialchars($_POST['comment']);
            $data = [
                'article_id' => $article_id,
                'user_id' => $_SESSION['id'],
                'comment' => $comment
            ];
            $frontController->postComment($data);
        }

        elseif ($_GET['action'] == 'deleteUserComment'){
            
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
        } 
   
        // if($_GET['action'] == 'contact'){
        //     $frontController->contactFront();
        // }
        // elseif($_GET['action'] == 'about'){
        //     $frontController->aboutFront();
        // }
       

    } else {
        $frontController->home();
    }
} catch (Exception $e) {
    require 'app/Views/front/errorLoading.php';
}

