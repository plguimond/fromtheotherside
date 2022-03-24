<?php
if(!isset($_SESSION)){
    session_start();
    }
// autoload.php généré avec composer
require_once __DIR__ . '/vendor/autoload.php';


try {
    $adminController = new \Projet\Controllers\AdminController(); // objet controler

    if (isset($_GET['action'])) {

      
        if ($_GET['action'] == 'dashboard') {
            $adminController->dashboard();
        }
        elseif ($_GET['action'] == 'disconnect') {
            session_destroy();
            header('location: index.php');
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
        $adminController->dashboard();
    }
} catch (Exception $e) {
    return $this->viewAdmin('errorLoading',$e);
}
