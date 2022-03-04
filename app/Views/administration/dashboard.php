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
        <section id="admin-sliders" class ="container">
            <h1>Ajouter, modifier ou supprimer une image du carroussel</h1>
            <?php foreach ($slides as $slide) { ?>
                <div class="update-slider">
                    <img class="admin-slider" src="<?= $slide['slide']; ?>" alt="<?= $slide['title']; ?>">
                    <form class="slider-form" action="indexAdmin.php?action=updateSlider&id=<?= $slide['id']; ?>" method="POST" enctype="multipart/form-data">
                        <label for="file">Fichier</label>
                        <input type="file" name="file">
                        <button type="submit">Modifier</button>

                    </form>
                </div>
            <?php } ?>
        </section>
    </main>
</body>

</html>