<?php include('app/Views/administration/layouts/header.php'); ?>

<main class="admin-content">
    <?php include('app/Views/administration/layouts/sidebar.php'); ?>
    <h1>Modifier l'article ou supprimer des photos</h1>
    <section id="singleNews-content">
        <form action="indexAdmin.php?action=updateNews" method="POST" enctype="multipart/form-data">
            <div id="singleNews-title">
                <p>
                    <label for="title">Le titre de l'article</label>
                </p>
                <p>
                    <input type="text" name="title" id="title" value="<?= $data['news']['title']?>"></h1>
                </p>
            </div>
            <div id="singleNews-text">
                <p>
                    <label for="content">Ecrire l'article ici</label>
                </p>
                <p>
                    <textarea name="content" id="content" cols="30" rows="10"><?= $data['news']['content']?></textarea>
                </p>
            </div>
            <?php 
            if($data['news']['picture1']){
            ?>
            <div class="news-picture">
                <img src="<?= $data['news']['picture1']?>" alt="première image de l'article">
                <div class="delete-picture">
                    <a href="indexAdmin.php?action=deletePicture&number=1&id=<?= $data['news']['id'] ?>" class="admin-button">Supprimer</a>
                </div>

            </div>
            <?php 
            }else{ 
            ?>
            <div class="news-picture add-pciture">
                <label for="picture1">Ajouter l'image 1</label>
                <input class="input-file" type="file" name="picture1" id="picture1">
            </div>
            <?php        
            }
            if($data['news']['picture2']){
            ?>
            <div class="news-picture ">
                <img src="<?= $data['news']['picture2']?>" alt="deuxième image de l'article">
                <div class="delete-picture">
                    <a href="indexAdmin.php?action=deletePicture&number=2&id=<?= $data['news']['id'] ?>" class="admin-button">Supprimer</a>
                </div>

            </div>
            <?php 
            }else{ 
            ?>
            <div class="news-picture add-picture">
                <label for="picture2">Ajouter l'image 2</label>
                <input class="input-file" type="file" name="picture2" id="picture1">
            </div>
            <?php        
            }
            if($data['news']['picture3']){
            ?>
            <div class="news-picture">
                <img src="<?= $data['news']['picture3']?>" alt="troisième image de l'article">
                
                <div class="delete-picture">
                    <a href="indexAdmin.php?action=deletePicture&number=3&id=<?= $data['news']['id'] ?>" class="admin-button">Supprimer</a>
                </div>
            </div>
            <?php 
            }else{ 
            ?>
            <div class="news-picture add-picture">
                <label for="picture2">Ajouter l'image 3</label>
                <input class="input-file" type="file" name="picture3" id="picture3">
            </div>
            
            <?php } ?>
            <div class="update-news">
                <button type="submit" class="admin-button">Modifier l'article</button>
            </div>
        </form>

    </section>

</main>

<?php include('app/Views/administration/layouts/footer.php'); ?>