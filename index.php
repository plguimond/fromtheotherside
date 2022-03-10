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

            $frontController->loginFront();
        } 
        elseif ($_GET['action'] == 'newAccount') {
            $frontController->newAccount();
        } 
        elseif ($_GET['action'] == 'createAccount') {
            $lastname = htmlspecialchars($_POST['lastname']);
            $firstname = htmlspecialchars($_POST['firstname']);
            $mail = htmlspecialchars($_POST['mail']);
            $pass = htmlspecialchars($_POST['pwd']);
            $password = password_hash($pass, PASSWORD_DEFAULT);
            if (!empty($lastname) && (!empty($firstname) && (!empty($mail) &&(!empty($password))))){
                $frontController->createAccount($lastname,$firstname, $mail, $password);
            }else {
                throw new Exception('Tous les champs ne sont pas remplis');
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
