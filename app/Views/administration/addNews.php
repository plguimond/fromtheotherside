<?php include('app/Views/administration/layouts/header.php'); ?>

<main class="admin-content">
    <?php include('app/Views/administration/layouts/sidebar.php'); ?>
    <section class="create-news">
        <h1 class="news-title">Ajouter ou modifier un article</h1>
        <p class="newsForm-description">Vous pouvez ajouter jusqu'à trois images à votre article (facultatif). Le titre et le contenu de l'article sont des champs onligatoires</p>
        <?php  
         if (isset($data['error'])){ 
             if($data['error'] != ""){ ?>
                <p class = "login-error"><?= $data['error'] ?></p>
         <?php }} ?>
         <!-- formulaire d'ajout d'article -->
        <form action="indexAdmin.php?action=createNews" method="POST" enctype="multipart/form-data">
            <div class="news-pictures">
                
                <div class="news-picture">
                    <p>Image</p>
                    <input class="input-file" type="file" name="picture1">
                </div>
            </div>
            <div class="news-title">
                <input type="text" name="title"   placeholder="Le titre de mon article" value="<?php if(isset($_POST["title"])) echo htmlspecialchars($_POST["title"]) ?>">
            </div>
            <div class="news-content">
                <textarea name="content"  placeholder="Rédigez votre article ici"><?php if(isset($_POST["content"])) echo htmlspecialchars($_POST["content"]) ?></textarea>
            </div>
      

            <button class="admin-button" type="submit">Ajouter</button>
    
        </form>
    </section>

</main>
<?php include('app/Views/administration/layouts/footer.php'); ?>