<?php
require_once './app/security/Connect.php';
$connect = isConnect();

if ($connect = true && $_SESSION['role'] == 1) {
?>

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
    <main>
        <section>
            <p>Bienvenue sur votre espace d'administration <?= $_SESSION['firstname']?></p>
        </section>
        <section id="admin-sliders" class="container">
            <h1>Ajouter, modifier ou supprimer une image du carroussel</h1>
            <?php if (isset($slides)) { ?>
                <?php foreach ($slides as $slide) { ?>
                    <div class="update-slider">
                        <img class="admin-slider" src="<?= $slide['slide']; ?>" alt="<?= $slide['title']; ?>">
                        <form class="slider-form" action="indexAdmin.php?action=updateSlider&id=<?= $slide['id']; ?>" method="POST" enctype="multipart/form-data">
                            <label for="file">Fichier</label>
                            <input type="file" name="file">
                            <label for="title">Titre de l'image</label>
                            <input type="text" name="title" value="<?= $slide['title']; ?>">
                            <button type="submit">Modifier</button>
                            <a href="indexAdmin.php?action=deleteSlide&id=<?= $slide['id']; ?>">Supprimer</a>
                        </form>

                    </div>
            <?php }
            } ?>
            <div class="add-slide">
                <form action="indexAdmin.php?action=addSlide" method="POST" enctype="multipart/form-data">
                    <label for="file">Fichier</label>
                    <input type="file" name="file">
                    <label for="title">Titre de l'image</label>
                    <input type="text" name="title" placeholder="Insérer le titre de l'image">
                    <button type="submit">Ajouter</button>
                </form>
            </div>
        </section>

        <a href="indexAdmin.php?action=disconnect">Déconnexion</a>
    </main>
</body>

</html>

<?php
} else {
    header('location: index.php?action=loginPage');
}

?>