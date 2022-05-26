<?php include('app/Views/administration/layouts/header.php');?>

<main class="admin-content">
    <?php include('app/Views/administration/layouts/sidebar.php'); ?>
    <section class="admin-concerts">
        <h1>Ajouter, modifier ou supprimer les informations d'un concert</h1>
        <?php  
      if (isset($data['error'])){ 
         if($data['error'] != ""){ ?>
        <p class="login-error"><?= $data['error'] ?></p>
        <?php }} ?>
        <h2>Ajouter un nouveau concert</h2>
        <div class="add-concert form-concert">
            <form action="indexAdmin.php?action=addConcert" method="POST">
               
                <p>Titre ou info sur le concert *<p>
                
                <p>
                    <textarea name="title" cols="37" rows="8" aria-label="Titre ou info sur le concert"> <?php if(isset($_POST["title"])) echo htmlspecialchars($_POST["title"]) ?></textarea>
                </p>
               
                <p>Date *</p>
               
                <p>
                    <input type="date" name="date" aria-label="Date" value="<?php if(isset($_POST["date"])) echo htmlspecialchars($_POST["date"]) ?>">
                </p>

                <p>Lieux du concert *</p>
                <p>
                    <input name="location" type="text" aria-label="Lieux de concert"
                        value="<?php if(isset($_POST["location"])) echo htmlspecialchars($_POST["location"]) ?>">
                </p>
                <p>Prix à partir de: </p>
                <p>
                    <input name="price" type="number" aria-label="Prix à partir de" value="<?php if(isset($_POST["price"])) echo htmlspecialchars($_POST["price"]) ?>"> €
                </p>
                <button class="admin-button" type="submit">Ajouter ce concert</button>
            </form>
        </div>

        <h2>Modifier un concert existant</h2>
        <div class="update-bloc">
        <?php foreach ($data['concerts'] as $concert){ ?>

            <div class="form-concert update-concerts">
                <form action="indexAdmin.php?action=updateConcert&id=<?= $concert['id'] ?>" method="POST">
                   
                    <p>Titre ou info sur le concert</p>
                    <p>
                        <textarea name="title" cols="37" rows="8" aria-label="Titre ou info sur le concert"><?= $concert['title'] ?></textarea>
                    </p>

                    <p>Date *</p>
                    <p>
                        <input type="date" name="date" value="<?= $concert['date'] ?>" aria-label="Date">
                    </p>
                    <p>Lieux du concert * </p>
                    <p>
                        <input type="text" name="location" value="<?= $concert['location']  ?>" aria-label="Lieux de concert">
                    </p>
                    <p>Prix à partir de:</p>
                    <p>
                        <input type="text" name="price" value="<?= $concert['price']  ?>" aria-label="Prix à partir de"> €
                    </p>
                    <button class="admin-button" type="submit">Modifier</button>
                </form>
                <a class="admin-button" href="indexAdmin.php?action=deleteConcert&id=<?= $concert['id']; ?>">Supprimer</a>
            </div>
        <?php }?>
        </div>
    </section>

</main>
<?php include('app/Views/administration/layouts/footer.php'); ?>