<?php
session_start();
// autoload.php généré avec composer
require_once __DIR__ . '/vendor/autoload.php';


try {
    $adminController = new \Projet\Controllers\AdminController(); // objet controler

    if (isset($_GET['action'])) {

        /* Actions de connexion/création compte utilisateur*/
        if ($_GET['action'] == 'login') {
            $mail = $_POST['mail'];
            $pwd = $_POST['pwd'];
            $adminController->login($mail, $pwd);
        }
        /* Actions correpondantes au slider de l'accueil fullscreen - update, add et delete */ 
        
        elseif ($_GET['action'] == 'updateSlider') {
            if (isset($_FILES['file']) && $_FILES['file']['name'] != "") {
                $sliders = [
                    'id' => $_GET['id'],
                    'title' => $_POST['title'],
                    'tmpName' => $_FILES['file']['tmp_name'],
                    'name' => $_FILES['file']['name'],
                    'size' => $_FILES['file']['size'],
                    'error' => $_FILES['file']['error']
                ];
                $adminController->updateSlider($sliders);
                $adminController->dashboard();
            } else {
                echo "Veuillez sélectionner une image.";
            }
        } elseif ($_GET['action'] == 'addSlide') {
            if (isset($_FILES['file']) && $_FILES['file']['name'] != "") {
        
                $title = $_POST['title'];
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $size = $_FILES['file']['size'];
                $error = $_FILES['file']['error'];
                $adminController->addSlide($title, $tmpName, $name, $size, $error);
                $adminController->dashboard();
            } else {
                echo "Veuillez sélectionner une image.";
            }
        } elseif ($_GET['action'] == 'deleteSlide') {
            $id = $_GET['id'];
            $adminController->deleteSlide($id);
            $adminController->dashboard();
        } elseif ($_GET['action'] == 'dashboard') {
            $adminController->dashboard();
        } elseif ($_GET['action'] == 'errorLoading') {
            require 'app/views/front/errorLoading.php';
        }
    } else {
        $frontController = new \Projet\Controllers\AdminController();
        $frontController->dashboard();
    }
} catch (Exception $e) {
    require 'app/views/front/errorLoading.php';
}
