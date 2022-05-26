<?php
require_once './app/security/Connect.php';
//booleen si connecté ou non
$connect = isConnect();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Groupe rock et métal en concert dans toute la Bretagne, dans vos bars, salle de spectacles ou réceptions privées">

    <title>From The Other Side - Groupe de musique rock en Bretagne</title>

    <link rel="stylesheet" href="app/Public/front/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

    <link rel="icon" type="image/png" href="app/Public/front/images/logo-groupe.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Metal+Mania&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">

</head>

<body>
    
    <header id="head">
        <div class="head-content">
            <!-- Menu burger pour le site -->
            <nav id="menu-head">
                <input id="burger-link" type="checkbox" aria-label="menu de navigation" />
               
                    <span id="burger"></span>
               
                <ul id="menu-list">
                    <li><a class="page-link" href="index.php">Accueil</a></li>
                    <li><a class="page-link" href="index.php?action=bandPage">Le groupe</a></li>
                    <li><a class="page-link" href="index.php?action=newsPage">Les news</a></li>
                    <li><a class="page-link" href="index.php?action=concertsPage">Prochaines dates</a></li>
                    <li><a class="page-link" href="index.php?action=contactPage">Nous contacter</a></li>
                  
                    <!-- Si admin, affichage lien dashboard, si user classique lien compte utilisateur -->
                    <?php if ($connect == true && $_SESSION['role'] == 1) { ?>
                        <li><a href="index.php?action=userPage">Dashboard</a></li>
                    <?php } elseif($connect == true) { ?>
                        <li><a href="index.php?action=userPage">Compte utilisateur</a></li>
                   <?php }
                //    Si connecté, lien déconnexion sinon lien vers connexion
                    if ($connect == true) { ?>
                        <li><a href="index.php?action=disconnect">Se déconnecter</a></li>
                    <?php } else{ ?>
                        <li><a href="index.php?action=loginPage">Connectez-vous</a></li>
                    <?php } ?>
                </ul>
            </nav>
            <div id="logo-header">
                <p class="logo">From The Other Side</p>
            </div>
            <!-- Div transparente pour créer le flou derrière le menu -->
            <div id="blur-me"></div>
        </div>
    </header>