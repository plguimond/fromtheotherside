<?php
require_once './app/security/Connect.php';
$connect = isConnect();

if ($connect = true && $_SESSION['role'] == 1) {
?>
<?php include('app/Views/administration/layouts/header.php'); ?>
<main class="admin-content">
    <?php include('app/Views/administration/layouts/sidebar.php'); ?>
    <section id="dashboard">
        <h1>Résumé de votre site web</h1>

        <article>
            <h2>Nombre de messages enregistrés</h2>
            <a href="indexAdmin.php?action=emailPage" class="counter">
                <p><?= $data['messages']?></p>
            </a>
        </article>

        <article>
            <h2>Nombre d'articles publiés</h2>
            <a href="indexAdmin.php?action=newsPage" class="counter">
                <p><?= $data['articles']?></p>
            </a>
        </article>

        <article>
            <h2>Nombre de concerts à venir</h2>
            <a href="indexAdmin.php?action=concertsPage" class="counter">
                <p><?= $data['concerts']?></p>
            </a>
        </article>
        <article>
            <h2>Membres du groupe</h2>
            <a href="indexAdmin.php?action=bandPage" class="counter">
                <p><?= $data['members']?></p>
            </a>
        </article>
    </section>


</main>
<?php include('app/Views/administration/layouts/footer.php'); ?>
<?php
}else {
    header('location: index.php?action=loginPage');
}
?>