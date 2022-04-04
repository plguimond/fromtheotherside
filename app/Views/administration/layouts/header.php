<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="app/Public/administration/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

</head>

<body>
    <header class="admin-head">
        
            <div class="head-content">

                <nav id="menu-head">
                    <input id="burger-link" type="checkbox" />
                    <!-- <a id="burger-link" href="#"> -->
                    <span id="burger"></span>
                    <!-- </a> -->
                    <ul id="menu-list">
                        <li><a href="indexAdmin.php">Dashboard</a></li>
                        <li><a href="indexAdmin.php?action=sliderPage">Modifier le slider</a></li>
                        <li><a href="indexAdmin.php?action=newsPage">Ajouter/modifier les news</a></li>
                        <li><a href="indexAdmin.php?action=concertsPage">Ajouter/modifier les concerts</a></li>
                        <li><a href="indexAdmin.php?action=bandPage">Membres du groupe</a></li>
                        <li><a href="indexAdmin.php?action=emailPage">Messagerie</a></li>
                        <li><a href="index.php" target="_blank">Visualiser le site internet</a></li>
                        <li><a href="indexAdmin.php?action=disconnect">Déconnexion</a></li>

                    </ul>
                </nav>
                <!-- Div transparente pour créer le flou derrière le menu -->
                <div id="blur-me"></div>
            </div>
            <p>Bienvenue sur votre espace d'administration <?= $_SESSION['firstname']?></p>
        
    </header>