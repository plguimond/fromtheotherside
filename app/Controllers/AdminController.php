<?php

namespace Projet\Controllers;

class AdminController{
   
    /* function login/create account */

    function login($mail, $pwd)
    {
        $errorLogin= "Les informations saisies sont incorrectes";
        $login = new \Projet\Models\AdminModel();
        $user = $login->getPwd($mail);
        $userInfo = $user->fetch();
        // $passwordVerify = password_verify($pwd, $userInfo['password']);
        
       if($userInfo != null){
        $_SESSION['id'] = $userInfo['id'];
        $_SESSION['lastname'] = $userInfo['lastname'];
        $_SESSION['firstname'] = $userInfo['firstname'];
        $_SESSION['mail'] = $userInfo['mail'];
        $_SESSION['password'] = $userInfo['password'];
        $_SESSION['role'] = $userInfo['role'];
        if ($pwd == $_SESSION['password'] &&  $_SESSION['role'] == 1 ) {
            header ('location: indexAdmin.php?action=dashboard');
        } else {
            
        }
    }else{
        require 'app/Views/front/login.php';
    }  
    }

    function dashboard()
    {
        $getSlider = new \Projet\Models\AdminModel();
        $getSlides = $getSlider->getSlides();
        $slides = $getSlides->fetchAll();
        require 'app/Views/administration/dashboard.php';
    }

    function updateSlider($id, $title, $tmpName, $name, $size, $error)
    {
        $slidePath = 'app/Public/front/images/'.$name;
        move_uploaded_file($tmpName, $slidePath);
        $sliderUpdate = new \Projet\Models\AdminModel();
        $updateSlider = $sliderUpdate->updateSlider($id, $title, $slidePath);
    }
    function addSlide($title, $tmpName, $name, $size, $error)
    {
        $slidePath = 'app/Public/front/images/'.$name;
        move_uploaded_file($tmpName, $slidePath);
        $addSlide = new \Projet\Models\AdminModel();
        $newSlider = $addSlide->addSlide($slidePath, $title);
    }
    function deleteSlide($id)
    {
        $slideDelete = new \Projet\Models\AdminModel();
        $deleteSlide = $slideDelete->deleteSlide($id);
    }
}