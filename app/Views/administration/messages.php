<?php include('app/Views/administration/layouts/header.php'); ?>

<main class="admin-content">
    <?php include('app/Views/administration/layouts/sidebar.php'); ?>

    <section class="admin-message">
        <h1 class="message-title">Emails</h1>
        <!-- TABLE -->
        <?php if (!empty($data['emails'])){ ?>
        <div class="email-table">
            <!-- tableau d'affichage des messages  -->
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Expéditeur</th>
                        <th class="fullscreen">Téléphone</th>
                        <th>Objet</th>
                        <th><span class="fullscreen">Actions</span></th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                
                //boucle affichage  message par ligne
                    foreach($data['emails'] as $email) { 
                ?>
                    <tr>

                        <td>
                            <?= $this->formatDate($email->createdAt); ?>
                        </td>
                        <td>
                            <div>
                                <span><?= $email->firstname; ?>
                                </span> <span><?= $email->lastname; ?></span>
                            </div>
                        </td>
                        <td class="fullscreen">
                            <?= $email->phone; ?>
                        </td>
                        <td>
                            <?php if ($email->subject != ""){?>
                            <p><?= $email->subject; ?></p>
                            <?php 
                        }else{
                        ?>
                            <p>Pas d'objet</p>
                            <?php 
                        }
                        ?>

                        </td>
                        <td>
                            <!-- boutons d'actions voir, supprimer  -->
                            <div class="action-icon">
                                <div>
                                    <a title="Lien vers le message complet" href="indexAdmin.php?action=viewMail&id=<?=$email->id;?>">
                                        <i class="fa-solid fa-eye show"></i>
                                    </a>
                                </div>

                                <div class="fullscreen">
                                    <a title="Bouton supprimer le message" href="indexAdmin.php?action=deleteMail&id=<?=$email->id;?>">
                                        <i class="fa-solid fa-trash-can trashcan"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
        <?php }else{ ?>
        <div>
            <p>Vous n'avez aucun mail enregistré</p>
        </div>
        <?php } ?>
    </section>

</main>
<?php include('app/Views/administration/layouts/footer.php'); ?>