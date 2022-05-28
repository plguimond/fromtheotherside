<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="app/Public/administration/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

    <link rel="icon" type="image/png" href="app/Public/front/images/logo-groupe.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">

</head>

<body>
    <header class="admin-head">
        <div class=" header-name fullscreen">
            <p>Espace Administrateur</p>
            </div>
            
            <div class="head-content">
            <!-- menu de navigation burger mobile -->
                <nav id="menu-head">
                    <input id="burger-link" type="checkbox" />
                
                    <span id="burger"></span>
                    
                    <ul id="menu-list">
                        <li><a href="indexAdmin.php" title="Lien vers le dashboard">Dashboard</a></li>
                        <li><a href="indexAdmin.php?action=sliderPage" title="Page de modification du slider">Modifier le slider</a></li>
                        <li><a href="indexAdmin.php?action=newsPage" title="Page de modification des articles">Ajouter/modifier les news</a></li>
                        <li><a href="indexAdmin.php?action=concertsPage" title="Page de modification des concerts">Ajouter/modifier les concerts</a></li>
                        <li><a href="indexAdmin.php?action=bandPage" title="Page de modification du groupe">Membres du groupe</a></li>
                        <li><a href="indexAdmin.php?action=emailPage" title="Page vers la messagerie">Messagerie</a></li>
                        <li><a href="index.php" target="_blank" title="Lien pour visiter le site public">Visualiser le site internet</a></li>
                        <li><a href="indexAdmin.php?action=disconnect" title="Bouton de déconnexion">Déconnexion</a></li>

                    </ul>
                </nav>
                
            </div>
            <p>Bienvenue sur votre espace d'administration <?= $_SESSION['firstname']?></p>
        
    </header>