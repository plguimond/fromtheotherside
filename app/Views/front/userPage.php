<?php
include('app/Views/front/layouts/header.php');
?>
<main id="user-page">
    <h1>Bonjour <?= $_SESSION['firstname']?></h1>

    <a href="indexAdmin.php?action=disconnect">Déconnexion</a>
</main>

<?php
include('app/Views/front/layouts/footer.php');
?>