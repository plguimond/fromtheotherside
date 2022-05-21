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

        <article class="counter">
            <h2>Nombre de messages enregistrés</h2>
            <div><a href="indexAdmin.php?action=emailPage"><?= $data['messages']?></a></div>
        </article>

        <article class="counter">
            <h2>Nombre d'articles publiés</h2>
            <div><a href="indexAdmin.php?action=newsPage"><?= $data['articles']?></a></div>
        </article>

        <article class="counter">
            <h2>Nombre de concerts à venir</h2>
            <div><a href="indexAdmin.php?action=concertsPage"><?= $data['concerts']?></a></div>
        </article>

        <article class="counter">
            <h2>Membres du groupe</h2>
            <div><a href="indexAdmin.php?action=bandPage"><?= $data['members']?></a></div>
        </article>   

    </section>


</main>
<?php include('app/Views/administration/layouts/footer.php'); ?>
<?php
}else {
    header('location: index.php?action=loginPage');
}
?>