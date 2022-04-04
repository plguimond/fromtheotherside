<?php include('app/Views/administration/layouts/header.php'); ?>
<?php include('app/Views/administration/layouts/sidebar.php'); ?>
<main class="admin-content">

    <section id="admin-sliders" class="container">
        <h1>Ajouter, modifier ou supprimer une image du carroussel</h1>

        <?php  
      if (isset($data['error'])){ 
         if($data['error'] != ""){ ?>
            <p class = "login-error"><?= $data['error'] ?></p>
   <?php }} ?>
   
        <?php if (isset($data)) { ?>
        <?php foreach ($data['slides'] as $slide) { ?>
        <div class="update-slider">
            <img class="admin-slider-image" src="<?= $slide['slide']; ?>" alt="<?= $slide['title']; ?>">
            <form class="slider-form" action="indexAdmin.php?action=updateSlider&id=<?= $slide['id']; ?>" method="POST"
                enctype="multipart/form-data">
                <label class="label-file" for="file">Modifier une Image</label>
                <input class="input-file" type="file" name="file">
                <label for="title">Titre de l'image</label>
                <input type="text" name="title" value="<?= $slide['title']; ?>">
                <div class="slide-form-buttons">
                    <button class="admin-button" type="submit">Modifier</button>
                    <a class="admin-button"
                        href="indexAdmin.php?action=deleteSlide&id=<?= $slide['id']; ?>">Supprimer</a>
                </div>
            </form>

        </div>
        <?php }
            } ?>
        <div class="add-slide">
            <form class="slider-form" action="indexAdmin.php?action=addSlide" method="POST"
                enctype="multipart/form-data">
                <label class="label-file" for="file">Ajouter une image</label>
                <input class="input-file" type="file" name="file">
                <label for="title">Titre de l'image</label>
                <input type="text" name="title" placeholder="Insérer le titre de l'image">
                <button class="admin-button" type="submit">Ajouter</button>
            </form>
        </div>
    </section>


</main>

<?php
    include('app/Views/administration/layouts/footer.php');
?>