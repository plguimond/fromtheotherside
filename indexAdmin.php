<?php

// autoload.php généré avec composer
require_once __DIR__ . '/vendor/autoload.php';


try {
    $adminController = new \Projet\Controllers\AdminController(); // objet controler

    if (isset($_GET['action'])) {

        // action pour envoyer  au controller les variables POST pour récupérer les infos admin
        if ($_GET['action'] == 'updateSlider') {
            if (isset($_FILES['file'])) {
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $size = $_FILES['file']['size'];
                $error = $_FILES['file']['error'];
                $adminController->updateSlider1($tmpName, $name, $size, $error);
            }else{
                echo "Une erreure s'est produite!";
            }
        }
    } else {
        $adminController->dashboard();
    }
} catch (Exception $e) {
    require 'app/views/front/errorLoading.php';
}
