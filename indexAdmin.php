<?php
if(!isset($_SESSION)){
    session_start();
    }
// autoload.php généré avec composer
require_once __DIR__ . '/vendor/autoload.php';
require_once './app/security/Connect.php';
$connect = isConnect();

if ($connect = true && $_SESSION['role'] == 1) {
try {
    $adminController = new \Projet\Controllers\AdminController(); // objet controler

    if (isset($_GET['action'])) {

      
        if ($_GET['action'] == 'dashboard') {
            $adminController->dashboard();
        }
        elseif ($_GET['action'] == 'sliderPage') {
            $adminController->sliderPage($error = null);
        }
        elseif ($_GET['action'] == 'disconnect') {
            session_destroy();
            header('location: index.php');
        }

        /* Actions correpondantes au slider - update, add et delete */ 
        
        elseif ($_GET['action'] == 'updateSlider') {

            if (isset($_FILES['file']) && $_FILES['file']['name'] != "") {
                $sliders = [
                    'id' => htmlspecialchars($_GET['id']),
                    'title' => htmlspecialchars($_POST['title']),
                    'tmpName' => $_FILES['file']['tmp_name'],
                    'name' => htmlspecialchars($_FILES['file']['name']),
                    'size' => $_FILES['file']['size'],
                ];

                $adminController->updateSlider($sliders);
                $adminController->sliderPage($error=null);
            } else {
                $error = "Veuillez sélectionner une image.";
                $adminController->sliderPage($error=null);
            }
        } elseif ($_GET['action'] == 'addSlide') {
            if (isset($_FILES['file']) && $_FILES['file']['name'] != "") {
        
                $title = htmlspecialchars($_POST['title']);
                $tmpName = $_FILES['file']['tmp_name'];
                $name = htmlspecialchars($_FILES['file']['name']);
                $size = $_FILES['file']['size'];
                $error = $_FILES['file']['error'];
                $adminController->addSlide($title, $tmpName, $name, $size, $error);
                $adminController->sliderPage($error = null);
            } else {
                $error = "Veuillez sélectionner une image.";
                $adminController->sliderPage($error);
            }
        } elseif ($_GET['action'] == 'deleteSlide') {
            $id = $_GET['id'];
            $adminController->deleteSlide($id);
            $adminController->sliderPage($error = null);
        } elseif ($_GET['action'] == 'dashboard') {
            $adminController->sliderPage($error = null);
        } elseif ($_GET['action'] == 'errorLoading') {
            require 'app/views/front/errorLoading.php';
        }
    } else {
        $adminController->dashboard();
    }
} catch (Exception $e) {
    return $this->viewAdmin('errorLoading',$e);
}
} else {
    header('location: index.php?action=loginPage');
}