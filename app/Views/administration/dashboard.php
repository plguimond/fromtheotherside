<?php
require_once './app/security/Connect.php';
$connect = isConnect();

if ($connect = true && $_SESSION['role'] == 1) {
?>
<?php include('app/Views/administration/layouts/header.php'); ?>
<main class="admin-content">
    <?php include('app/Views/administration/layouts/sidebar.php'); ?>
    <p>infos</p>


</main>
<?php include('app/Views/administration/layouts/footer.php'); ?>
<?php
}else {
    header('location: index.php?action=loginPage');
}
?>