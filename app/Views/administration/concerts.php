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
                <p>
                    <label for="title">Titre ou info sur le concert *</label>
                </p>
                <p>
                    <textarea name="title" cols="37"
                        rows="8"><?php if(isset($_POST["title"])) echo htmlspecialchars($_POST["title"]) ?></textarea>
                </p>
                <p>
                    <label for="date">Date *</label>
                </p>
                <p>
                    <input type="date" name="date" value="<?php if(isset($_POST["date"])) echo htmlspecialchars($_POST["date"]) ?>">
                </p>

                <p>
                    <label for="location">Lieux du concert *</label>
                </p>
                <p>
                    <input name="location" type="text"
                        value="<?php if(isset($_POST["location"])) echo htmlspecialchars($_POST["location"]) ?>">
                </p>
                <p>
                    <label for="price">Prix à partir de:</label>
                </p>
                <p>
                    <input name="price" type="text" value="<?php if(isset($_POST["price"])) echo htmlspecialchars($_POST["price"]) ?>"> €
                </p>
                <button class="admin-button" type="submit">Ajouter ce concert</button>
            </form>
        </div>

        <h2>Modifier un concert existant</h2>

        <?php foreach ($data['concerts'] as $concert){ ?>

        <div class="form-concert update-concerts">
            <form action="indexAdmin.php?action=updateConcert&id=<?= $concert['id'] ?>" method="POST">
                <p>
                    <label for="title">Titre ou info sur le concert</label>
                </p>
                <p>
                    <textarea name="title" cols="37" rows="8"><?= $concert['title'] ?></textarea>
                </p>
                <p>
                    <label for="date">Date *</label>
                </p>
                <p>
                    <input type="date" name="date" value="<?= $concert['date'] ?>">
                </p>
                <p>
                    <label for="location">Lieux du concert *</label>
                </p>
                <p>
                    <input type="text" name="location" value="<?= $concert['location']  ?>">
                </p>
                <p>
                    <label for="price">Prix à partir de:</label>
                </p>
                <p>
                    <input type="text" name="price" value="<?= $concert['price']  ?>"> €
                </p>
                <button class="admin-button" type="submit">Modifier</button>
            </form>
            <a class="admin-button" href="indexAdmin.php?action=deleteConcert&id=<?= $concert['id']; ?>">Supprimer</a>
        </div>
        <?php }?>
    </section>

</main>
<?php include('app/Views/administration/layouts/footer.php'); ?>