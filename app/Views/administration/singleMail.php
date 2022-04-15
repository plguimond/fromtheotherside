<?php include('app/Views/administration/layouts/header.php'); ?>

<main class="admin-content">
    <?php include('app/Views/administration/layouts/sidebar.php'); ?>

    <section class="admin-singleMail">
        <div class="singleMail">
            <?php if ($data['email']['subject'] == ""){?>
            <h1 class="message-title">Pas d'objet</h1>
            <?php }else{ ?>
            <h1 class="message-title"><?= $data['email']['subject'] ?> </h1>
            <?php }?>
            <div class="single-mail-header">
                <div class="contact-info">
                    <p><?= $data['email']['firstname'] . " " . $data['email']['lastname'] ?></p>
                    <p><a href="mailto:<?= $data['email']['mail'] ?>"><?= $data['email']['mail'] ?></a></p>
                    <p><?= $data['email']['phone'] ?></p>
                </div>
                <p><?= $data['email']['createdAt'] ?></p>
            </div>
            <div class="single-mail-body">
                <p><?= $data['email']['content'] ?></p>
            </div>
            <div class="single-mail-footer">
                <div>
                    <a href="mailto:<?= $data['email']['mail'] ?>">
                        <i class="fa-solid fa-reply reply"></i>
                    </a>
                </div>

                <div>
                    <a href="indexAdmin.php?action=deleteMail&id=<?=$data['email']['id'];?>">
                        <i class="fa-solid fa-trash-can trashcan"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>
<?php include('app/Views/administration/layouts/footer.php'); ?>