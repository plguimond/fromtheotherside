<?php
//démarre la session si ce n'est pas déjà fait
if(!isset($_SESSION)){
    session_start();
    }
// autoload.php généré avec composer
require_once __DIR__ . '/vendor/autoload.php';
require_once './app/security/Connect.php';

// vérifie qu'il y a un utilisateur dans la session
$connect = isConnect();

//si l'utilisateur est admin, acces au backoffice sinon redirection
if ($connect = true && $_SESSION['role'] == 1) {
try {

    $adminController = new \Projet\Controllers\AdminController(); // objet controler

    // vérifie qu'il y a une action dans l'url
    if (isset($_GET['action'])) {

        // actions de redirecion vers différentes pages
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

        // bouton déconnexion, detruit la session en cours et redirige vers la page d'accueil
        elseif ($_GET['action'] == 'disconnect') {
            session_destroy();
            header('location: index.php');
        }

        /* Actions correpondantes au slider - update, add et delete */ 
        
        // Mise à jour d'une slide
        elseif ($_GET['action'] == 'updateSlider') {

            // récupère toute les infos du formulaire
                $sliders = [
                    'id' => htmlspecialchars($_GET['id']),
                    'title' => htmlspecialchars($_POST['title']),
                    'tmpName' => $_FILES['file']['tmp_name'],
                    'name' => htmlspecialchars($_FILES['file']['name']),
                    'size' => $_FILES['file']['size'],
                ];

                // Les données sont envoyées au controller et ensuite rechargement de la page
                $adminController->updateSlider($sliders);
                $adminController->sliderPage($error=null);
           
        //function pour l'ajout d'une nouvelle slide
        } elseif ($_GET['action'] == 'addSlide') {
            //vérification s'il y a un fichier dans le formulaire
            if (isset($_FILES['file']) && $_FILES['file']['name'] != "") {
            //création d'un tableau avec les information du formulaire
                $sliders = [
                    'title' =>  htmlspecialchars($_POST['title']),
                    'tmpName' => $_FILES['file']['tmp_name'],
                    'name' => htmlspecialchars($_FILES['file']['name']),
                    'size' => $_FILES['file']['size'],
                ];

                // le controller se charge d'ajouter en bdd la nouvele slide et on recharge la page
                $adminController->addSlide($sliders);
                $adminController->sliderPage($error = null);
            } else {
                $error = "Veuillez sélectionner une image.";
                $adminController->sliderPage($error);
            }

        //action de suppression d'une slide
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

            //suppression de la photo d'un article
        } elseif ($_GET['action'] == 'deletePicture') {
            
            $adminController->deletePicture($_GET['number'], $_GET['id']);
            
            

// action connexion au dashboard

        } elseif ($_GET['action'] == 'dashboard') {
            $adminController->dashboard();

        // retourne un code d'exception si l'action n'est pas dans l'index
        } else{
            throw new Exception("La page n'existe pas", 404);
        }
 
// Absence d'action redirection vers dashboard        
    } else {
       
        $adminController->dashboard();
    }

    // redirecton sur les pages d'erreurs si il y en a
} catch (Exception $e) {
    if ($e->getCode() == 404){
        header('Location: index.php?action=404');
    }
    header('Location: index.php?action=errorLoading');
}catch (Error $e) {
    header('Location: index.php?action=errorLoading');
}

// Absence de droit d'administration redirection vers la page login
} else {
    header('location: index.php?action=loginPage');
}