<?php

// important pour la sécurité de vos scripts : les sessions
// démarre une session
session_start();


// autoload.php généré avec composer
require_once __DIR__ . '/vendor/autoload.php';


try {

    $frontController = new \Projet\Controllers\FrontController(); // objet controler

    if (isset($_GET['action'])) {

        if ($_GET['action'] == 'bandPage') {
            $frontController->bandFront();
        } 
        elseif ($_GET['action'] == 'newsPage') {
            $frontController->newsFront();
        } 
        elseif ($_GET['action'] == 'concertsPage') {
            $frontController->concertsFront();
        } 
        elseif ($_GET['action'] == 'contactPage') {
            $frontController->contactFront();
        } 
        elseif ($_GET['action'] == 'loginPage') {
            /*récupération des variables du formulaire de connexion*/
         
            $frontController->loginFront($error = "");
        }
        elseif ($_GET['action'] == 'login') {
            /*récupération des variables du formulaire de connexion*/
            $mail = ($_POST['mail']);
            $pass = ($_POST['pwd']);

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
            /*récupération des variables du formulaire création de compte*/
            $lastname = htmlspecialchars($_POST['lastname']);
            $firstname = htmlspecialchars($_POST['firstname']);
            $mail = htmlspecialchars($_POST['mail']);
            $pass = htmlspecialchars($_POST['pwd']);
            $password = password_hash($pass, PASSWORD_DEFAULT);
            /* test si les champs sont tous remplis */
            if (!empty($lastname) && (!empty($firstname) && (!empty($mail) &&(!empty($password))))){
                $frontController->createAccount($lastname,$firstname, $mail, $password);
            }else {
                $error = "Vous devez remplir tous les champs.";
                $frontController->newAccount($error);
            }
        }


        
        // if($_GET['action'] == 'contact'){
        //     $frontController->contactFront();
        // }
        // elseif($_GET['action'] == 'about'){
        //     $frontController->aboutFront();
        // }
        // elseif($_GET['action'] == 'contactPost'){
        //     $lastname = htmlspecialchars($_POST['name']);
        //     $firstname = htmlspecialchars($_POST['firstname']);
        //     $mail = htmlspecialchars($_POST['mail']);
        //     $phone = htmlspecialchars($_POST['phone']);
        //     $objet = htmlspecialchars($_POST['object']);
        //     $content = htmlspecialchars($_POST['content']);

        //     if (!empty($lastname) && (!empty($firstname) && (!empty($mail) && (!empty($phone) && (!empty($mail) && (!empty($objet) && (!empty($content)))))))){
        //         $frontController->contactPost($lastname, $firstname, $mail, $phone, $objet, $content);
        //     }else {
        //         throw new Exception('Tous les champs ne sont pas remplis');
        //     }
        // } 
    } else {
        $frontController->home();
    }
} catch (Exception $e) {
    require 'app/Views/front/errorLoading.php';
}
