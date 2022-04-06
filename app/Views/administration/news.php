<?php include('app/Views/administration/layouts/header.php'); ?>

<main class="admin-content">
    <?php include('app/Views/administration/layouts/sidebar.php'); ?>

    <section class="admin-news">
       <?php var_dump($data['news']) ?>
    </section>

</main>
<?php include('app/Views/administration/layouts/footer.php'); ?>