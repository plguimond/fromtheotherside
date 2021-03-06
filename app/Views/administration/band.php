<?php include('app/Views/administration/layouts/header.php'); ?>

<main class="admin-content">
    <?php include('app/Views/administration/layouts/sidebar.php'); ?>
    <div id="admin-band">
        <h1>Ajouter, modifier ou supprimer un membre du groupe</h1>

        <?php
        // ffichage des messages d'erreurs si il y en a  
      if (isset($data['error'])){ 
         if($data['error'] != ""){ ?>
        <p class="login-error"><?= $data['error'] ?></p>
        <?php }} ?>

        <section id="add-member">
            <h2>Ajout d'un nouveau membre</h2>

            <!-- formulaire d'ajout d'un membre -->
            <form action="indexAdmin.php?action=addMember" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <img src="app/Public/front/images/default.jpg" alt="Photo générique d'une guitare">
                        <p class="label-file">Ajouter une image</p>
                        <input class="input-file" type="file" name="file" aria-label="Ajouter une image">
                    </div>
                    <div class="card-body">
                        <p class="member-name">
                            <input type="text" name="firstname" placeholder="Prénom"
                                value="<?php if(isset($_POST["firstname"])) echo htmlspecialchars($_POST["firstname"]) ?>">
                            <input type="text" name="lastname" placeholder="Nom de famille"
                                value="<?php if(isset($_POST["lastname"])) echo htmlspecialchars($_POST["lastname"]) ?>">
                        </p>
                        <p class="member-type"> <input type="text" name="type" placeholder="Guitariste? Pianiste? etc."
                                value="<?php if(isset($_POST["type"])) echo htmlspecialchars($_POST["type"]) ?>"></p>

                        <p class="member-excerpt"><input type="text" name="excerpt"
                                placeholder="Court message de présentation"
                                value="<?php if(isset($_POST["excerpt"])) echo htmlspecialchars($_POST["excerpt"]) ?>">
                        </p>
                    </div>
                    <div class="card-footer">
                        <p class="member-info">
                            <textarea name="info" cols="30" rows="10"
                                placeholder="Information de votre choix sur le membre du groupe"><?php if(isset($_POST["info"])) echo htmlspecialchars($_POST["info"]) ?></textarea>
                        </p>

                    </div>
                    <button class="admin-button" type="submit">Ajouter</button>
                </div>
            </form>
        </section>

        <section id="members-update">
            <h2>Modification des membres actuels</h2>
        <?php 
        foreach($data['band'] as $member){ 
        ?>
            <!-- formulaire de modification d'un membre -->
            <form action="indexAdmin.php?action=updateMember&id=<?= $member->id; ?>" method="POST"
                enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <img src="<?= $member->picture?>" alt="Photo du <?= $member->type ?>">
                        <p class="label-file">Ajouter une image</p>
                        <input class="input-file" type="file" name="file" aria-label="Ajouter une image">
                    </div>
                    <div class="card-body">
                        <p class="member-name">
                            <input type="text" name="firstname" value="<?= $member->firstname;?>">
                            <input type="text" name="lastname" value="<?= $member->lastname;?>">
                        </p>
                        <p class="member-type"> <input type="text" name="type" value="<?= $member->type;?>"></p>

                        <p class="member-excerpt"><input type="text" name="excerpt" value="<?= $member->excerpt;?>"></p>
                    </div>
                    <div class="card-footer">
                        <p class="member-info">
                            <textarea name="info" cols="30" rows="10"><?= $member->info;?></textarea>
                        </p>

                    </div>
                    <button class="admin-button" type="submit">Modifier</button>
                    <a title="Bouton supprimer ce membre" class="admin-button" href="indexAdmin.php?action=deleteMember&id=<?= $member->id; ?>">Supprimer</a>
                </div>
            </form>

            <?php }?>
        </section>
    </div>
</main>
<?php include('app/Views/administration/layouts/footer.php'); ?>