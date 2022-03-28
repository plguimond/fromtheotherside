<?php include('app/Views/administration/layouts/header.php'); ?>
<?php include('app/Views/administration/layouts/sidebar.php'); ?>
<main class="admin-content">
        
        <section id="admin-sliders" class="container">
            <h1>Ajouter, modifier ou supprimer une image du carroussel</h1>
            <?php if (isset($data)) { ?>
                <?php foreach ($data as $slide) { ?>
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