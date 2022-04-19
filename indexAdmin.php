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
        elseif ($_GET['action'] == 'emailPage') {

            $adminController->emailPage();
        }
        elseif ($_GET['action'] == 'concertsPage') {

            $adminController->concertsPage($error = null);
        }
        elseif ($_GET['action'] == 'newsPage') {

            $adminController->newsPage();
        }
        
        elseif ($_GET['action'] == 'bandPage') {

            $adminController->bandPage($error = null);
        }

        elseif ($_GET['action'] == 'disconnect') {
            session_destroy();
            header('location: index.php');
        }

        /* Actions correpondantes au slider - update, add et delete */ 
        
        elseif ($_GET['action'] == 'updateSlider') {

            
                $sliders = [
                    'id' => htmlspecialchars($_GET['id']),
                    'title' => htmlspecialchars($_POST['title']),
                    'tmpName' => $_FILES['file']['tmp_name'],
                    'name' => htmlspecialchars($_FILES['file']['name']),
                    'size' => $_FILES['file']['size'],
                ];

                $adminController->updateSlider($sliders);
                $adminController->sliderPage($error=null);
           
        } elseif ($_GET['action'] == 'addSlide') {
            if (isset($_FILES['file']) && $_FILES['file']['name'] != "") {
                $sliders = [

                  'title' =>  htmlspecialchars($_POST['title']),
                    'tmpName' => $_FILES['file']['tmp_name'],
                    'name' => htmlspecialchars($_FILES['file']['name']),
                    'size' => $_FILES['file']['size'],
                ];
                $adminController->addSlide($sliders);
                $adminController->sliderPage($error = null);
            } else {
                $error = "Veuillez sélectionner une image.";
                $adminController->sliderPage($error);
            }
        } elseif ($_GET['action'] == 'deleteSlide') {
            $id = htmlspecialchars($_GET['id']);
            $adminController->deleteSlide($id);
            $adminController->sliderPage($error = null);

// Action pour les functions de la messagerie admin

        } elseif ($_GET['action'] == 'deleteMail') {
            $id = htmlspecialchars($_GET['id']);
            $adminController->deleteMail($id);
            $adminController->emailPage();

        } elseif ($_GET['action'] == 'viewMail') {
            $id = htmlspecialchars($_GET['id']);
            $adminController->viewMail($id);


// Actions pour la page concerts Admin
        } elseif ($_GET['action'] == 'addConcert') {
            $adminController->addConcert($_POST);

        } elseif ($_GET['action'] == 'updateConcert') {
            $adminController->updateConcert($_POST, $_GET['id']);
            
        } elseif ($_GET['action'] == 'deleteConcert') {
            $adminController->deleteConcert($_GET['id']);

    
  /* Actions correpondantes au membre du groupe - update, add et delete */ 
        
        }elseif ($_GET['action'] == 'updateMember') {
            $adminController->updateMember($_GET['id'],$_FILES,$_POST);
        
        } elseif ($_GET['action'] == 'addMember') {
            $adminController->addMember($_FILES,$_POST);
        
        } elseif ($_GET['action'] == 'deleteMember') {
            $adminController->deleteMember($_GET['id']);

  /* Actions correpondantes au articles- update, add et delete */ 

        }elseif ($_GET['action'] == 'viewNews') {
            $adminController->viewNews($_GET['id']);    
        
        }elseif ($_GET['action'] == 'addNewsPage') {
            $adminController->addNewsPage($error = null);    
        
        }elseif ($_GET['action'] == 'updateNews') {
            $adminController->updateNews($_GET['id'],$_FILES,$_POST);
        
        } elseif ($_GET['action'] == 'createNews') {

            $adminController->createNews($_FILES, $_POST);
        
        } elseif ($_GET['action'] == 'deleteNews') {
            $adminController->deleteNews($_GET['id']);

        } elseif ($_GET['action'] == 'deletePicture') {
            
            $adminController->deletePicture($_GET['number'], $_GET['id']);
            
            

// action connexion au dashboard

        } elseif ($_GET['action'] == 'dashboard') {
            $adminController->dashboard();

        } elseif ($_GET['action'] == 'errorLoading') {
            require 'app/views/front/errorLoading.php';
        }
 
// Absence d'action redirection vers dashboard        
    } else {
        $adminController->dashboard();
    }

}  catch (Exception $e) {
    if ($e->getCode() == 404){
        require 'app/Views/front/404.php';
    }
    require 'app/Views/front/errorLoading.php';
}catch (Error $e) {
    require 'app/Views/front/errorLoading.php';
}

// Absence de droit d'administration redirection vers la page login
} else {
    header('location: index.php?action=loginPage');
}