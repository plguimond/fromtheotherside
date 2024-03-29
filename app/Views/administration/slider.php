<?php include('app/Views/administration/layouts/header.php'); ?>
<main class="admin-content" >
    <?php include('app/Views/administration/layouts/sidebar.php'); ?>

    <section id="admin-sliders" >
        <h1>Ajouter, modifier ou supprimer une image du carroussel</h1>

        <?php  
      if (isset($data['error'])){ 
         if($data['error'] != ""){ ?>
            <p class = "login-error"><?= $data['error'] ?></p>
   <?php }} ?>

        <?php if (isset($data)) { ?>
        <?php foreach ($data['slides'] as $slide) { ?>
        <div class="update-slider">
            <!-- formulaire de modification du sider dans un boucle -->
            <form class="slider-form" action="indexAdmin.php?action=updateSlider&id=<?= $slide['id']; ?>" method="POST"
                enctype="multipart/form-data">
                <p class="label-file">Modifier une Image</p>
                <input class="input-file" type="file" name="file" aria-label="Modifier une Image">
                <p>Titre de l'image</p>
                <input type="text" name="title" value="<?= $slide['title']; ?>" aria-label="Titre de l'image">
                <div class="slide-form-buttons">
                    <button class="admin-button" type="submit">Modifier</button>
                    <a title="Supprimer cet image du slider" class="admin-button" href="indexAdmin.php?action=deleteSlide&id=<?= $slide['id']; ?>">Supprimer</a>
                </div>
            </form>
            <img class="admin-slider-image" src="<?= $slide['slide']; ?>" alt="<?= $slide['title']; ?>">

        </div>
        <?php }
            } ?>
        <div class="add-slide">
            <!-- formulaire d'ajout d'une nouvelle slide -->
            <form class="slider-form" action="indexAdmin.php?action=addSlide" method="POST"
                enctype="multipart/form-data">
                <p class="label-file">Ajouter une Image</p>
                <input class="input-file" type="file" name="file" aria-label="Ajouter une Image">
                <p>Titre de l'image</p>
                <input type="text" name="title" placeholder="Insérer le titre de l'image" aria-label="Titre de l'image">
                <button class="admin-button" type="submit">Ajouter</button>
            </form>
        </div>
    </section>


</main>
<?php include('app/Views/administration/layouts/footer.php'); ?>
