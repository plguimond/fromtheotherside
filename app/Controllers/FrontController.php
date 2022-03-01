<?php

namespace Projet\Controllers;

class FrontController{
   
    function home()
    {
        require 'app/Views/front/home.php';
    }
    
    function testUser()
    {
        $testUser = new \Projet\Models\HomeModel();
        $userTest = $testUser->testUser();
        $users = $userTest->fetchAll();
        require 'app/Views/front/home.php';
    }

//     function contactFront()
//     {
//         require 'app/Views/front/contact.php';
//     }

//     function aboutFront()
//     {
//         require 'app/Views/front/about.php';
//     }
//     /* *********** mail formaulaire de contact ************** */
//     function contactPost($lastname, $firstname, $mail, $phone, $objet, $content)
//     {
//         $postMail = new \Projet\Models\ContactModel();

//         if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
//             $email = $postMail->postMail($lastname, $firstname, $mail, $phone, $objet, $content);
//             require 'app/Views/front/confirmeContact.php';
//         }else{
//             header('Location: app/Views/front/error.php');
//         }
//     }

}